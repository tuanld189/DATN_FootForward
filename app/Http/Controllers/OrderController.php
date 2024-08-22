<?php

namespace App\Http\Controllers;

use App\Events\OrderShipped;
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
use App\Models\Vourcher;
use App\Notifications\OrderUpdated;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Notification;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            if (!Auth::check()) {
                $userCode = Str::random(10);
                $name = Str::random(8);

                $user = User::create([
                    'name' => $request->input('user_name'),
                    'email' => $request->input('user_email'),
                    'phone' => $request->input('user_phone'),
                    'address' => $request->input('user_address'),
                    'password' => bcrypt($request->input('user_password')),
                    'username' => $name,
                    'user_code' => $userCode,
                    'status' => null,
                    'fullname' => $request->input('user_name')
                ]);
                if ($user) {
                    Log::info('User created successfully: ' . $user->id);
                } else {
                    Log::error('Failed to create user');
                }
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
            $order->user_id = Auth::check() ?  $request->input('user_id') :  $user->id;
            $order->user_password = Auth::check() ? null :  $request->input('user_password');
            $order->order_code = $request->input('order_code');
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

            session()->forget('cart');
            return $this->vnpay_payment($request, $order->id);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            dd('Database error: ' . $e->getMessage(), $e);
            // return back()->with('error', 'Đã xảy ra lỗi với cơ sở dữ liệu. Vui lòng thử lại sau.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd('General error: ' . $e->getMessage(), $e);
            // return back()->with('error', 'Đã xảy ra lỗi không xác định. Vui lòng thử lại sau.');
        }
    }



    public function vnpay_payment(Request $request, $orderId)
    {

        $order = Order::findOrFail($orderId);


        $totalAmount = session()->get('total_amount', $order->total_price);

        Log::info('Total amount for payment: ' . $totalAmount);


        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";


        $vnp_Returnurl = route('order.vnpay_return', ['order_id' => $orderId]);


        $vnp_TmnCode = "XBZGT2AU";
        $vnp_HashSecret = "4GA17SQ9XWMQNJCCNJ6Y8P4IT7O4OW81";
        $vnp_TxnRef = Str::random(10);
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $totalAmount * 100;
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
        $query = rtrim($query, '&');


        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);


        $vnp_Url .= "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;

        Log::info('VNPAY payment URL: ' . $vnp_Url);

        return redirect($vnp_Url);
    }




    // Hàm tính toán số tiền giảm giá
    private function calculateDiscount($voucher, $orderTotal)
    {
        $discountAmount = 0;

        if ($voucher->discount_type === 'percent') {
            $discountAmount = ($voucher->discount_value / 100) * $orderTotal;
        } elseif ($voucher->discount_type === 'fixed') {
            $discountAmount = $voucher->discount_value;
        }

        return $discountAmount;
    }





    // public function vnpay_return(Request $request)
    // {
    //     $orderId = $request->input('order_id');
    //     $order = Order::findOrFail($orderId);

    //     if ($request->input('vnp_ResponseCode') == '00') {
    //         $order->status_payment = Order::STATUS_PAYMENT_PAID;

    //         // Cập nhật giá trị của đơn hàng sau khi áp dụng mã giảm giá
    //         $order->total_price = session()->get('total_amount', $order->total_price);
    //         $order->save();
    //     } else {
    //         $order->status_payment = Order::STATUS_PAYMENT_UNPAID;
    //         $order->save();
    //     }
    //     return redirect()->route('order.confirmation', ['order_id' => $orderId]);
    // }
    public function vnpay_return(Request $request)
    {
        $orderId = $request->input('order_id');
        $order = Order::findOrFail($orderId);

        if ($request->input('vnp_ResponseCode') == '00') {
            $order->status_payment = Order::STATUS_PAYMENT_PAID;

            $order->total_price = session()->get('total_amount', $order->total_price);
            $order->save();

            event(new OrderShipped($order));
            $user = $order->user;
            Notification::send($user, new OrderUpdated($order));
        } else {
            $order->status_payment = Order::STATUS_PAYMENT_UNPAID;
            $order->save();
            event(new OrderShipped($order));
            $user = $order->user;
            Notification::send($user, new OrderUpdated($order));
        }
        // Xóa mã giảm giá sau khi thanh toán nếu cần
        // session()->forget('voucher_code');

        return redirect()->route('order.confirmation', ['order_id' => $orderId]);
    }




    public function confirmation($order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->get();

        return view('client.order-confirmation', compact('order', 'orderItems'));
    }



    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $orderDetails = [
            'order_code' => $order->id,
            'order_date' => $order->created_at->format('d M, Y'),
            'order_status' => Order::STATUS_ORDER[$order->status_order],
            'payment_status' => Order::STATUS_PAYMENT[$order->status_payment],
            'total_amount' => number_format($order->total_price + 0, 0, ',', '.') . 'VNĐ',
            'customer_name' => $order->user_name,
            'customer_address' => $order->user_address,
            'customer_phone' => $order->user_phone,
            'user_note' => $order->user_note,
            'products' => $order->orderItems->map(function ($item) {
                return [
                    'name' => $item->product_name,
                    'price' => number_format($item->product_price, 0, ',', '.') . ' VNĐ',
                    'color' => $item->variant_color_name,
                    'size' => $item->variant_size_name,
                    'quantity' => $item->quantity_add,
                    'amount' => number_format($item->product_price * $item->quantity_add, 0, ',', '.') . ' VNĐ',
                ];
            }),
        ];

        Log::info('Order Details:', $orderDetails);
        return response()->json($orderDetails);
        // return response()->json($orderDetails);
    }


    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status_order = $request->input('status_order');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }


    public function showOrderLookupForm()
    {
        return view('client.order-lookup'); // Trả về view cho trang tra cứu đơn hàng
    }
}
