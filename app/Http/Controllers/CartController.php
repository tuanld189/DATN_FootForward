<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductVariant;
use App\Models\Vourcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function home()
    {
        $cart = session('cart', []);

        return view('client.home', compact('cart', 'totalAmount'));
    }
    public function list()
    {
        $cart = session('cart', []);

        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
        }

        return view('client.cart-list', compact('cart', 'totalAmount'));
    }


    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'nullable|string',
        ]);

        $voucherCode = $request->input('voucher_code');
        $totalAmount = session()->get('total_amount', 0); // Đảm bảo có giá trị mặc định

        if ($voucherCode) {
            $voucher = Vourcher::validateVoucher($voucherCode); // Sửa lỗi tên lớp từ `Vourcher` thành `Voucher`

            if ($voucher) {
                // Xác định giới hạn giảm giá dựa trên tổng số tiền đơn hàng
                if ($totalAmount >= 3000000) {
                    $minDiscountPercent = 1;
                    $maxDiscountPercent = 25;
                    $minDiscountValue = 10000;
                    $maxDiscountValue = 500000;
                } elseif ($totalAmount >= 2000000) {
                    $minDiscountPercent = 1;
                    $maxDiscountPercent = 15;
                    $minDiscountValue = 10000;
                    $maxDiscountValue = 300000;
                } elseif ($totalAmount >= 1000000) {
                    $minDiscountPercent = 1;
                    $maxDiscountPercent = 10;
                    $minDiscountValue = 10000;
                    $maxDiscountValue = 100000;
                } elseif ($totalAmount >= 500000) {
                    $minDiscountPercent = 1;
                    $maxDiscountPercent = 5;
                    $minDiscountValue = 10000;
                    $maxDiscountValue = 50000;
                } else {
                    Log::warning('Order amount too low for voucher: ' . $totalAmount); // Ghi log khi tổng số tiền không đủ
                    return redirect()->route('cart.checkout')->with('error', 'Tổng số tiền đơn hàng không đủ điều kiện áp dụng mã giảm giá');
                }

                // Tính toán số tiền giảm giá từ phần trăm
                $percentDiscount = $totalAmount * ($voucher->discount_value / 100);

                // Xác định số tiền giảm giá theo phần trăm và giá tiền
                $discountValue = min(max($percentDiscount, $minDiscountValue), $maxDiscountValue);

                // Nếu số tiền giảm theo phần trăm không hợp lệ, tính giảm giá theo giá tiền cố định
                if ($voucher->discount_type == 'percentage') {
                    if ($voucher->discount_value < $minDiscountPercent || $voucher->discount_value > $maxDiscountPercent) {
                        Log::warning('Voucher discount percentage out of range: ' . $voucher->discount_value); // Ghi log khi giảm giá theo phần trăm không nằm trong khoảng hợp lệ
                        return redirect()->route('cart.checkout')->with('error', 'Mã giảm giá không hợp lệ với tổng số tiền đơn hàng của bạn');
                    }
                } else {
                    if ($voucher->discount_value < $minDiscountValue || $voucher->discount_value > $maxDiscountValue) {
                        Log::warning('Voucher discount value out of range: ' . $voucher->discount_value); // Ghi log khi giảm giá theo giá tiền không nằm trong khoảng hợp lệ
                        return redirect()->route('cart.checkout')->with('error', 'Mã giảm giá không hợp lệ với tổng số tiền đơn hàng của bạn');
                    }
                }

                // Tính toán số tiền giảm
                $discount = min($discountValue, $totalAmount); // Đảm bảo số tiền giảm không vượt quá tổng số tiền
                $newTotalAmount = max(0, $totalAmount - $discount); // Cập nhật tổng số tiền, đảm bảo không âm

                // Lưu mã giảm giá và số tiền vào session
                session([
                    'voucher_code' => $voucherCode,
                    'discount' => $discount,
                    'total_amount' => $newTotalAmount
                ]);

                // Redeem the voucher
                $voucher->redeem();


                Log::info('Voucher applied. New total amount: ' . $newTotalAmount); // Ghi log giá trị mới

                return redirect()->route('cart.checkout')->with('success', 'Voucher áp dụng thành công');
            }
        }

        Log::warning('Invalid or expired voucher: ' . $voucherCode); // Ghi log khi voucher không hợp lệ

        return redirect()->route('cart.checkout')->with('error', 'Voucher không hợp lệ hoặc hết hạn');
    }





    // Hàm tính toán số tiền giảm giá
    private function calculateDiscount($voucher, $totalAmount)
    {
        if ($voucher->discount_type === 'percentage') {
            return ($voucher->discount_value / 100) * $totalAmount;
        } elseif ($voucher->discount_type === 'amount') {
            return $voucher->discount_value;
        }
        return 0;
    }

    // private function calculateDiscount($voucher, $orderTotal)
    // {
    //     $discountAmount = 0;

    //     if ($voucher->discount_type === 'percent') {
    //         $discountAmount = ($voucher->discount_value / 100) * $orderTotal;
    //     } elseif ($voucher->discount_type === 'fixed') {
    //         $discountAmount = $voucher->discount_value;
    //     }

    //     return $discountAmount;
    // }

    // public function checkout(Request $request)
    // {
    //     $cart = session()->get('cart', []);
    //     $totalAmount = 0;

    //     foreach ($cart as $item) {
    //         $totalAmount += $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
    //     }

    //     $voucherCode = session()->get('voucher_code');
    //     $discount = 0;

    //     if ($voucherCode) {
    //         $voucher = Vourcher::validateVoucher($voucherCode);

    //         if ($voucher) {
    //             $discount = $this->calculateDiscount($voucher, $totalAmount);

    //             // Xóa mã giảm giá khỏi session sau khi áp dụng
    //             session()->forget(['voucher_code', 'discount', 'total_amount']);
    //         }
    //     }

    //     // Giả sử bạn có thông tin về khu vực trong request hoặc session
    //     // Bạn có thể thay đổi logic này để lấy thông tin từ request hoặc cơ sở dữ liệu
    //     $location = $request->input('location', 'noi_thanh'); // 'noi_thanh' hoặc 'ngoai_thanh'
    //     $shippingFee = $location === 'noi_thanh' ? 0 : 50000;

    //     // Lưu thông tin giảm giá và tổng số tiền vào session
    //     session()->put('total_amount', $totalAmount);
    //     session()->put('discount', $discount);
    //     session()->put('shipping_fee', $shippingFee);

    //     return view('client.cart-checkout', compact('cart', 'totalAmount', 'discount', 'shippingFee', 'voucherCode'));
    // }


    // cái nay dung ok
    public function checkout(Request $request)
    {
        $vourchers = Vourcher::where('is_active', true)->get();
        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
        }

        $voucherCode = session()->get('voucher_code');
        $discount = 0;
        if ($voucherCode) {
            $voucher = Vourcher::validateVoucher($voucherCode);

            if ($voucher) {
                $discount = $this->calculateDiscount($voucher, $totalAmount);
                $totalAmount = max(0, $totalAmount - $discount); // Cập nhật tổng số tiền, đảm bảo không âm

                // Xóa mã giảm giá khỏi session sau khi áp dụng
                session()->forget(['voucher_code', 'discount', 'total_amount']);
            }
        }

        // Lưu thông tin giảm giá và tổng số tiền vào session
        session()->put('total_amount', $totalAmount);
        session()->put('discount', $discount);
        return view('client.cart-checkout', compact('cart', 'totalAmount', 'discount', 'voucherCode', 'vourchers'));
    }
    // cái nay dung ok



    // public function checkout(Request $request)
    // {
    //     $cart = session()->get('cart', []);
    //     $totalAmount = 0;

    //     foreach ($cart as $item) {
    //         $totalAmount += $item['quantity_add'] * ($item['sale_price'] ?: $item['price']);
    //     }

    //     $voucherCode = session()->get('voucher_code');
    //     $discount = 0;

    //     if ($voucherCode) {
    //         $voucher = Vourcher::validateVoucher($voucherCode);

    //         if ($voucher) {
    //             if ($voucher->discount_type === 'percentage') {
    //                 $discount = ($voucher->discount_value / 100) * $totalAmount;
    //             } elseif ($voucher->discount_type === 'amount') {
    //                 $discount = $voucher->discount_value;
    //             }
    //             $totalAmount -= $discount;
    //         }
    //     }

    //     // Lưu thông tin giảm giá và tổng số tiền vào session
    //     session()->put('total_amount', $totalAmount);
    //     session()->put('discount', $discount);
    //     return view('client.cart-checkout', compact('cart', 'totalAmount', 'discount', 'voucherCode'));
    // }


    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_size_id' => 'required|exists:product_variants,product_size_id',
            'product_color_id' => 'required|exists:product_variants,product_color_id',
            'quantity_add' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $productVariant = ProductVariant::where([
            'product_id' => $request->product_id,
            'product_size_id' => $request->product_size_id,
            'product_color_id' => $request->product_color_id,
        ])->firstOrFail();

        $cart = session()->get('cart', []);

        $sale = ProductSale::whereHas('products', function ($query) use ($request) {
            $query->where('products.id', $request->product_id);
        })->active()->first();

        $salePrice = $sale ? $sale->sale_price : null;


        if (isset($cart[$productVariant->id])) {
            $cart[$productVariant->id]['quantity_add'] += $request->quantity_add;
        } else {
            $cart[$productVariant->id] = [
                'id' => $productVariant->id,
                'name' => $product->name,
                'image' => $product->img_thumbnail,
                'price' => $product->price,
                'sale_price' => $salePrice,
                'category_id' => $product->category_id,
                'brand_id' => $product->brand_id,
                'sku' => $product->sku,
                'slug' => $product->slug,
                'description' => $product->description,
                'color' => $productVariant->color,
                'size' => $productVariant->size,
                'quantity_add' => $request->quantity_add,
            ];
        }
        session()->put('cart', $cart);
        // dd(session('cart'));
        return redirect()->route('cart.list');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity_add' => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity_add'] = $request->input('quantity_add');
            session(['cart' => $cart]);
            return redirect()->route('cart.list')->with('success', 'Cart updated successfully');
        }

        return redirect()->route('cart.list')->with('error', 'Product not found in cart');
    }

    public function updateMultiple(Request $request)
    {
        $updatedCart = $request->input('updated_cart');

        $cart = session()->get('cart', []);

        foreach ($updatedCart as $item) {
            $id = $item['id'];
            if (isset($cart[$id])) {
                $cart[$id]['quantity_add'] = $item['quantity_add'];
            }
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true]);
    }


    public function remove($id)
    {

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.list')->with('success', 'Product removed successfully');
        }

        return redirect()->route('cart.list')->with('error', 'Product not found in cart');
    }

    // public function confirmation() {
    //     // Retrieve order data from the session or database

    //     $cart = session()->get('cart');
    //     $discountCode = 'MGD062024';
    //     $totalValue = 1000; // Example value
    //     $totalDiscount = 500; // Example value
    //     $shippingFee = 500; // Example value
    //     $totalPayment = 1000; // Example value
    //     $customerName = 'John Doe';
    //     $customerEmail = 'john.doe@example.com';
    //     $customerAddress = '123 Main St, City, Country';
    //     $customerPhone = '123-456-7890';
    //     $paymentMethod = 'Credit Card';

    //     return view('client.cart-confirmation', compact(
    //         'cart', 'discountCode', 'totalValue', 'totalDiscount', 'shippingFee', 'totalPayment', 'customerName', 'customerEmail', 'customerAddress', 'customerPhone', 'paymentMethod'
    //     ));
    // }

}











