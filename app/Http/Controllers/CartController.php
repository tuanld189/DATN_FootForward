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


    // public function applyVoucher(Request $request)
    // {
    //     $request->validate([
    //         'voucher_code' => 'nullable|string',
    //     ]);

    //     $voucherCode = $request->input('voucher_code');
    //     $totalAmount = session()->get('total_amount'); // Tổng số tiền hiện tại

    //     if ($voucherCode) {
    //         $voucher = Vourcher::validateVoucher($voucherCode);

    //         if ($voucher) {
    //             // Tính toán số tiền giảm
    //             $discount = $voucher->discount_value; // Hoặc cách tính giảm giá tùy thuộc vào loại voucher
    //             $newTotalAmount = $totalAmount - $discount; // Cập nhật tổng số tiền

    //             // Lưu mã giảm giá và số tiền vào session
    //             session(['voucher_code' => $voucherCode]);
    //             session(['discount' => $discount]);
    //             session(['total_amount' => $newTotalAmount]);

    //             return redirect()->route('cart.checkout')->with('success', 'Voucher applied successfully');
    //         }
    //     }

    //     return redirect()->route('cart.checkout')->with('error', 'Invalid or expired voucher');
    // }


    // public function applyVoucher(Request $request)
    // {
    //     $request->validate([
    //         'voucher_code' => 'nullable|string',
    //     ]);

    //     $voucherCode = $request->input('voucher_code');
    //     $totalAmount = session()->get('total_amount', 0); // Đảm bảo có giá trị mặc định

    //     if ($voucherCode) {
    //         $voucher = Vourcher::validateVoucher($voucherCode); // Sửa lỗi tên lớp từ `Vourcher` thành `Voucher`

    //         if ($voucher) {
    //             // Tính toán số tiền giảm
    //             $discount = $this->calculateDiscount($voucher, $totalAmount); // Sử dụng hàm calculateDiscount để tính toán số tiền giảm
    //             $newTotalAmount = $totalAmount - $discount; // Cập nhật tổng số tiền

    //             // Lưu mã giảm giá và số tiền vào session
    //             session(['voucher_code' => $voucherCode]);
    //             session(['discount' => $discount]);
    //             session(['total_amount' => $newTotalAmount]);

    //             Log::info('Voucher applied. New total amount: ' . $newTotalAmount); // Ghi log giá trị mới

    //             return redirect()->route('cart.checkout')->with('success', 'Voucher applied successfully');
    //         }
    //     }

    //     Log::warning('Invalid or expired voucher: ' . $voucherCode); // Ghi log khi voucher không hợp lệ

    //     return redirect()->route('cart.checkout')->with('error', 'Invalid or expired voucher');
    // }

    // public function applyVoucher(Request $request)
    // {
    //     $request->validate([
    //         'voucher_code' => 'nullable|string',
    //     ]);

    //     $voucherCode = $request->input('voucher_code');
    //     $totalAmount = session()->get('total_amount', 0); // Đảm bảo có giá trị mặc định

    //     if ($voucherCode) {
    //         $voucher = Vourcher::validateVoucher($voucherCode);
    //         if ($voucher) {
    //             // Tính toán số tiền giảm
    //             $discount = $this->calculateDiscount($voucher, $totalAmount);
    //             $newTotalAmount = $totalAmount - $discount;

    //             // Lưu mã giảm giá và số tiền vào session tạm thời
    //             session([
    //                 'current_voucher_code' => $voucherCode,
    //                 'current_discount' => $discount,
    //                 'total_amount' => $newTotalAmount, // Cập nhật tổng số tiền với giảm giá
    //             ]);

    //             Log::info('Voucher applied. New total amount: ' . $newTotalAmount);

    //             return redirect()->route('cart.checkout')->with('success', 'Voucher applied successfully');
    //         } else {
    //             // Xóa mã giảm giá khỏi session nếu không hợp lệ
    //             session()->forget(['current_voucher_code', 'current_discount']);

    //             Log::warning('Invalid or expired voucher: ' . $voucherCode);
    //             return redirect()->route('cart.checkout')->with('error', 'Invalid or expired voucher');
    //         }
    //     } else {
    //         // Xóa thông tin mã giảm giá khỏi session nếu không có mã giảm giá
    //         session()->forget(['current_voucher_code', 'current_discount']);

    //         return redirect()->route('cart.checkout')->with('info', 'No voucher applied');
    //     }
    // }

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
                // Tính toán số tiền giảm
                $discount = $this->calculateDiscount($voucher, $totalAmount); // Sử dụng hàm calculateDiscount để tính toán số tiền giảm
                $newTotalAmount = max(0, $totalAmount - $discount); // Cập nhật tổng số tiền, đảm bảo không âm

                // Lưu mã giảm giá và số tiền vào session
                session([
                    'voucher_code' => $voucherCode,
                    'discount' => $discount,
                    'total_amount' => $newTotalAmount
                ]);

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
        return view('client.cart-checkout', compact('cart', 'totalAmount', 'discount', 'voucherCode'));
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
