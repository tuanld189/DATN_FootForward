<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function save(Request $request)
    {
        try {
            // Declare $order variable outside the transaction scope
            $order = null;

            DB::transaction(function () use ($request, &$order) {
                // Check if the user is authenticated
                if (!Auth::check()) {
                    // Generate random user_code and username
                    $userCode = Str::random(10);
                    $username = Str::random(8);

                    // Create a new user
                    $user = User::create([
                        'name' => $username,
                        'email' => $request->input('user_email'),
                        'password' => bcrypt($request->input('user_email')),
                        'username' => $request->input('user_name'),
                        'user_code' => $userCode,
                        'status' => NULL,
                    ]);
                } else {
                    // User is authenticated, use the logged-in user
                    $user = Auth::user();
                }

                // Calculate total amount and prepare order items
                $totalAmount = 0;
                $dataItem = [];

                foreach (session('cart') as $variantID => $item) {
                    $totalAmount += $item['quantity_add'] * ($item['price'] ?: $item['sale_price']);

                    $dataItem[] = [
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

                // Create the order
                $order = Order::create([
                    'user_id' => Auth::check() ? Auth::id() : $user->id,
                    'user_name' => $request->input('user_name'),
                    'user_email' => $request->input('user_email'),
                    'user_phone' => $request->input('user_phone'),
                    'user_address' => $request->input('user_address'),
                    'user_note' => $request->input('user_note'),
                    'total_price' => $totalAmount,
                ]);

                // Create order items
                foreach ($dataItem as $item) {
                    $item['order_id'] = $order->id;
                    OrderItem::create($item);

                    // Update product variant quantity
                    $productVariant = ProductVariant::findOrFail($item['product_variant_id']);
                    $productVariant->quantity -= $item['quantity_add'];
                    $productVariant->save();
                }
            });

            // Clear the cart after successful order placement
            session()->forget('cart');

            // Redirect to order confirmation page with order_id
            return redirect()->route('order.confirmation', ['order_id' => $order->id]);

        } catch (\Exception $exception) {
            // Handle exceptions
            // Log the exception for debugging
            \Log::error('Order placement error: ' . $exception->getMessage());
            return back()->with('error', 'Lỗi đặt hàng');
        }
    }
    public function vnpay_payment(Request $request)
    {


        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://datn.test/order-confirmation";
        $vnp_TmnCode = "XBZGT2AU"; // Mã website tại VNPAY
        $vnp_HashSecret = "4GA17SQ9XWMQNJCCNJ6Y8P4IT7O4OW81"; // Chuỗi bí mật

        $vnp_TxnRef = "12345"; // Mã đơn hàng
        $vnp_OrderInfo = "Thanh toán đơn hàng";
        $vnp_OrderType = "FootForward";
        $vnp_Amount = 10000 * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = $request->input('bank_code'); // Validate and sanitize user input
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
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00'
            ,
            'message' => 'success'
            ,
            'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }


    public function confirmation($order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->get();

        return view('client.order-confirmation', compact('order', 'orderItems'));
    }
}
