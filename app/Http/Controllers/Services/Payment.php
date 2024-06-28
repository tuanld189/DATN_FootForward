<?php
namespace App\Http\Services;

use App\Jobs\SendOrderConfirmation;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Payment
{
    public function store(Request $request)
    {
        $order_code = Str::random(10);
        $value = $request->all();

        try {
            if ($request['payment_method'] != 'VNPAYQR') {
                $this->saveData($value, session('cart'));
                session()->forget('cart');
                return redirect()->route('home');
            } else if ($request['payment_method'] == 'VNPAYQR') {
                $this->saveData($value, session('cart'));
                $url = $this->paymentVNPAY($value['after_total_amount'], $order_code);
                session()->forget('cart');
                return redirect()->away($url);
            }
        } catch (\Exception $e) {
            // Xử lý ngoại lệ (log, thông báo lỗi, ...)
            return redirect()->route('checkout')->withErrors(['error' => 'Thanh toán không thành công. Vui lòng thử lại.']);
        }
    }

    public function paymentVNPAY($after_total_amount, $order_code)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('bill.return');
        $vnp_TmnCode = env('VNP_TMN_CODE'); // Lưu trong .env
        $vnp_HashSecret = env('VNP_HASH_SECRET'); // Lưu trong .env

        $vnp_TxnRef = $order_code;
        $vnp_OrderInfo = 'Thanh toán hóa đơn';
        $vnp_OrderType = 'Nong San Viet Fam';
        $vnp_Amount = $after_total_amount * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

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

        ksort($inputData);
        $query = "";
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            $hashdata .= ($hashdata ? '&' : '') . urlencode($key) . "=" . urlencode($value);
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $vnp_Url .= "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    public function saveData($data, $dataProducts)
    {
        return DB::transaction(function () use ($data, $dataProducts) {
            $order = Order::create($data);
            $products = [];
            foreach ($dataProducts as $id => $item) {
                $products[$id] = [
                    'name' => $item['name'],
                    'image' => $item['image'],
                    'price_regular' => $item['price_regular'],
                    'price_sale' => $item['price_sale'],
                    'quantity' => $item['quantity']
                ];
            }
            $this->updateQuantityProduct($products);
            $order->products()->attach($products);
            return $order;
        });
    }

    private function updateQuantityProduct($products)
    {
        foreach ($products as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $product->quantity -= $item['quantity'];
                $product->save();
            }
        }
    }

    public function pay_return(Request $request)
    {
        $responseCode = $request->input('vnp_ResponseCode');
        if ($responseCode == "00") {
            return redirect()->route('home');
        } else {
            return redirect()->route('checkout')->withErrors(['error' => 'Thanh toán không thành công. Vui lòng thử lại.']);
        }
    }
}
