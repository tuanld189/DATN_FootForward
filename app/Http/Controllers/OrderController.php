<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\OrderPlacedEmail;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderShipped;
use Carbon\Carbon;
class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!Auth::check()) {
                $userCode = Str::random(10);
                $username = Str::random(8);

                $user = User::create([
                    'name' => $username,
                    'email' => $request->input('user_email'),
                    'password' => bcrypt($request->input('user_email')),
                    'username' => $request->input('user_name'),
                    'user_code' => $userCode,
                    'status' => null,
                ]);
            } else {
                $user = Auth::user();
            }

            $totalAmount = 0;
            $orderItems = [];

            foreach (session('cart') as $variantID => $item) {
                $totalAmount += $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);

                $orderItems[] = [
                    'product_variant_id' => $variantID,
                    'quantity_add' => $item['quantity_add'],
                    'product_name' => $item['name'],
                    'product_sku' => $item['sku'],
                    'product_image' => $item['image'],
                    'product_price' => $item['price'],
                    'product_sale_price' => $item['sale_price'],
                    'variant_size_name' => $item['size']['name'],
                    'variant_color_name' => $item['color']['name'],
                ];
            }

            $order = new Order();
            $order->user_id = Auth::check() ? $user->id : null;
            $order->user_name = $request->input('user_name');
            $order->user_email = $request->input('user_email');
            $order->user_phone = $request->input('user_phone');
            $order->user_address = $request->input('user_address');
            $order->user_note = $request->input('user_note');
            $order->total_price = $totalAmount;

            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $order->created_at = $now;
            $order->pending_at = $now;

            $order->save();


            foreach ($orderItems as $item) {
                    $item['order_id'] = $order->id;
                    OrderItem::create($item);

                    $productVariant = ProductVariant::findOrFail($item['product_variant_id']);
                    $productVariant->quantity -= $item['quantity_add'];
                    $productVariant->save();
            }

            DB::commit();


            event(new OrderShipped($order));

            session()->forget('cart');
            return $this->vnpay_payment($request, $order->id);

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Error placing order: ' . $exception->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi khi đặt hàng. Vui lòng thử lại sau.');
        }
    }

    public function vnpay_payment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $totalAmount = $order->total_price;

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('order.vnpay_return', ['order_id' => $orderId]);
        $vnp_TmnCode = "XBZGT2AU";
        $vnp_HashSecret = "4GA17SQ9XWMQNJCCNJ6Y8P4IT7O4OW81";
        $vnp_TxnRef = Str::random(10); // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "FootForward";
        $vnp_Amount = $totalAmount*100;
        $vnp_Locale = "vn";
        $vnp_BankCode = $request->input('bank_code');
        $vnp_IpAddr = $request->ip();

        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        ];

        if ($vnp_BankCode) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpay_return(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::findOrFail($orderId);

        if ($request->input('vnp_ResponseCode') == '00') {
            $order->status_payment = Order::STATUS_PAYMENT_PAID;
            $order->save();
        } else {
            $order->status_payment = Order::STATUS_PAYMENT_UNPAID;
            $order->save();
        }

        return redirect()->route('order.confirmation', ['order_id' => $orderId]);
    }

     public function confirmation($order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->get();

        return view('client.order-confirmation', compact('order', 'orderItems'));
    }






}
