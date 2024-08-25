<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\ProductVariant;
use App\Models\Province;
use App\Models\Vourcher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
    //     $totalAmount = session()->get('total_amount', 0); // Đảm bảo có giá trị mặc định

    //     if ($voucherCode) {
    //         $voucher = Vourcher::validateVoucher($voucherCode); // Sửa lỗi tên lớp từ `Vourcher` thành `Voucher`

    //         if ($voucher) {
    //             // Xác định giới hạn giảm giá dựa trên tổng số tiền đơn hàng
    //             if ($totalAmount >= 10000000) {
    //                 $minDiscountPercent = 1;
    //                 $maxDiscountPercent = 18;
    //                 $minDiscountValue = 10000;
    //                 $maxDiscountValue = 1800000;
    //             } elseif ($totalAmount >= 5000000) {
    //                 $minDiscountPercent = 1;
    //                 $maxDiscountPercent = 15;
    //                 $minDiscountValue = 10000;
    //                 $maxDiscountValue = 750000;
    //             } elseif ($totalAmount >= 3000000) {
    //                 $minDiscountPercent = 1;
    //                 $maxDiscountPercent = 12;
    //                 $minDiscountValue = 10000;
    //                 $maxDiscountValue = 360000;
    //             } elseif ($totalAmount >= 2000000) {
    //                 $minDiscountPercent = 1;
    //                 $maxDiscountPercent = 10;
    //                 $minDiscountValue = 10000;
    //                 $maxDiscountValue = 200000;
    //             } elseif ($totalAmount >= 1000000) {
    //                 $minDiscountPercent = 1;
    //                 $maxDiscountPercent = 8;
    //                 $minDiscountValue = 10000;
    //                 $maxDiscountValue = 80000;
    //             } elseif ($totalAmount >= 500000) {
    //                 $minDiscountPercent = 1;
    //                 $maxDiscountPercent = 5;
    //                 $minDiscountValue = 10000;
    //                 $maxDiscountValue = 50000;
    //             } else {
    //                 Log::warning('Order amount too low for voucher: ' . $totalAmount); // Ghi log khi tổng số tiền không đủ
    //                 return redirect()->route('cart.checkout')->with('error', 'Tổng số tiền đơn hàng không đủ điều kiện áp dụng mã giảm giá');
    //             }

    //             // Tính toán số tiền giảm giá từ phần trăm
    //             $percentDiscount = $totalAmount * ($voucher->discount_value / 100);

    //             // Xác định số tiền giảm giá theo phần trăm và giá tiền
    //             $discountValue = min(max($percentDiscount, $minDiscountValue), $maxDiscountValue);

    //             // Nếu số tiền giảm theo phần trăm không hợp lệ, tính giảm giá theo giá tiền cố định
    //             if ($voucher->discount_type == 'percentage') {
    //                 if ($voucher->discount_value < $minDiscountPercent || $voucher->discount_value > $maxDiscountPercent) {
    //                     Log::warning('Voucher discount percentage out of range: ' . $voucher->discount_value); // Ghi log khi giảm giá theo phần trăm không nằm trong khoảng hợp lệ
    //                     return redirect()->route('cart.checkout')->with('error', 'Mã giảm giá không hợp lệ với tổng số tiền đơn hàng của bạn');
    //                 }
    //             } else {
    //                 if ($voucher->discount_value < $minDiscountValue || $voucher->discount_value > $maxDiscountValue) {
    //                     Log::warning('Voucher discount value out of range: ' . $voucher->discount_value); // Ghi log khi giảm giá theo giá tiền không nằm trong khoảng hợp lệ
    //                     return redirect()->route('cart.checkout')->with('error', 'Mã giảm giá không hợp lệ với tổng số tiền đơn hàng của bạn');
    //                 }
    //             }

    //             // Tính toán số tiền giảm
    //             $discount = min($discountValue, $totalAmount); // Đảm bảo số tiền giảm không vượt quá tổng số tiền
    //             $newTotalAmount = max(0, $totalAmount - $discount); // Cập nhật tổng số tiền, đảm bảo không âm

    //             // Lưu mã giảm giá và số tiền vào session
    //             session([
    //                 'voucher_code' => $voucherCode,
    //                 'discount' => $discount,
    //                 'total_amount' => $newTotalAmount
    //             ]);

    //             // Redeem the voucher
    //             $voucher->redeem();


    //             Log::info('Voucher applied. New total amount: ' . $newTotalAmount); // Ghi log giá trị mới

    //             return redirect()->route('cart.checkout')->with('success', 'Voucher áp dụng thành công');
    //         }
    //     }

    //     Log::warning('Invalid or expired voucher: ' . $voucherCode); // Ghi log khi voucher không hợp lệ

    //     return redirect()->route('cart.checkout')->with('error', 'Voucher không hợp lệ hoặc hết hạn');
    // }

    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'nullable|string',
        ]);

        $voucherCode = $request->input('voucher_code');
        $totalAmount = session()->get('total_amount', 0);

        if ($voucherCode) {
            $voucher = Vourcher::validateVoucher($voucherCode);

            if ($voucher) {
                $discountLevels = [
                    ['minAmount' => 10000000, 'minPercent' => 1, 'maxPercent' => 18, 'minValue' => 10000, 'maxValue' => 1800000],
                    ['minAmount' => 5000000,  'minPercent' => 1, 'maxPercent' => 15, 'minValue' => 10000, 'maxValue' => 750000],
                    ['minAmount' => 3000000,  'minPercent' => 1, 'maxPercent' => 12, 'minValue' => 10000, 'maxValue' => 360000],
                    ['minAmount' => 2000000,  'minPercent' => 1, 'maxPercent' => 10, 'minValue' => 10000, 'maxValue' => 200000],
                    ['minAmount' => 1000000,  'minPercent' => 1, 'maxPercent' => 8,  'minValue' => 10000, 'maxValue' => 80000],
                    ['minAmount' => 500000,   'minPercent' => 1, 'maxPercent' => 5,  'minValue' => 10000, 'maxValue' => 50000]
                ];

                $validDiscount = false;
                foreach ($discountLevels as $level) {
                    if ($totalAmount >= $level['minAmount']) {
                        $minDiscountPercent = $level['minPercent'];
                        $maxDiscountPercent = $level['maxPercent'];
                        $minDiscountValue = $level['minValue'];
                        $maxDiscountValue = $level['maxValue'];
                        $validDiscount = true;
                        break;
                    }
                }

                if (!$validDiscount) {
                    Log::warning('Order amount too low for voucher: ' . $totalAmount);
                    return redirect()->route('cart.checkout')->with('error', 'Tổng số tiền đơn hàng không đủ điều kiện áp dụng mã giảm giá');
                }

                // Tính toán số tiền giảm giá từ phần trăm
                $percentDiscount = $totalAmount * ($voucher->discount_value / 100);
                $discountValue = min(max($percentDiscount, $minDiscountValue), $maxDiscountValue);

                // Kiểm tra loại giảm giá và áp dụng
                if ($voucher->discount_type == 'percentage') {
                    if ($voucher->discount_value < $minDiscountPercent || $voucher->discount_value > $maxDiscountPercent) {
                        Log::warning('Voucher discount percentage out of range: ' . $voucher->discount_value); // Ghi log khi giảm giá theo phần trăm không hợp lệ
                        return redirect()->route('cart.checkout')->with('error', 'Mã giảm giá không hợp lệ với tổng số tiền đơn hàng của bạn');
                    }
                } else {
                    if ($voucher->discount_value < $minDiscountValue || $voucher->discount_value > $maxDiscountValue) {
                        Log::warning('Voucher discount value out of range: ' . $voucher->discount_value); // Ghi log khi giảm giá theo giá trị không hợp lệ
                        return redirect()->route('cart.checkout')->with('error', 'Mã giảm giá không hợp lệ với tổng số tiền đơn hàng của bạn');
                    }
                }

                // Tính toán số tiền giảm giá cuối cùng
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


    // cái nay dung ok
    public function checkout(Request $request)
{
    $orderCode = 'FF-' . strtoupper(Str::random(10));
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
    $user = auth()->user();
    // Fetch the provinces to pass to the view
    $provinces = Province::all(); // Assumes you have a Province model and table

    return view('client.cart-checkout', compact('cart', 'user','totalAmount', 'discount', 'voucherCode', 'vourchers', 'orderCode', 'provinces'));
}
    // cái nay dung ok


    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'product_size_id' => 'required|exists:product_variants,product_size_id',
            'product_color_id' => 'required|exists:product_variants,product_color_id',
            'quantity_add' => 'required|integer|min:1|max:5', // Giới hạn số lượng từ 1 đến 5
        ]);

        $product = Product::findOrFail($request->product_id);
        $productVariant = ProductVariant::where([
            'product_id' => $request->product_id,
            'product_size_id' => $request->product_size_id,
            'product_color_id' => $request->product_color_id,
        ])->firstOrFail();

        $quantityAdd = $request->quantity_add;

        // Kiểm tra số lượng trong kho
        if ($productVariant->quantity <= 0) {
            return redirect()->back()->withErrors(['quantity_add' => 'Sản phẩm hiện không còn hàng.']);
        }

        $cart = session()->get('cart', []);

        $sale = ProductSale::whereHas('products', function ($query) use ($request) {
            $query->where('products.id', $request->product_id);
        })->active()->first();

        $salePrice = $sale ? $sale->sale_price : null;

        if (isset($cart[$productVariant->id])) {
            // Kiểm tra tổng số lượng trong giỏ hàng
            $totalQuantity = $cart[$productVariant->id]['quantity_add'] + $quantityAdd;
            if ($totalQuantity > 5) {
                return redirect()->back()->withErrors(['quantity_add' => 'Số lượng tối đa là 5 sản phẩm.']);
            }
            $cart[$productVariant->id]['quantity_add'] = $totalQuantity;
        } else {
            if ($quantityAdd > 5) {
                return redirect()->back()->withErrors(['quantity_add' => 'Số lượng tối đa là 5 sản phẩm.']);
            }
            $cart[$productVariant->id] = [
                'id' => $productVariant->id,
                'name' => $product->name,
                'image' => $productVariant->image,
                'price' => $product->price,
                'sale_price' => $salePrice,
                'category_id' => $product->category_id,
                'brand_id' => $product->brand_id,
                'sku' => $product->sku,
                'slug' => $product->slug,
                'description' => $product->description,
                'color' => $productVariant->color,
                'size' => $productVariant->size,
                'quantity_add' => $quantityAdd,
            ];
        }

        session()->put('cart', $cart);
        // dd($cart);
        return redirect()->route('cart.list');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity_add' => 'required|integer|min:1|max:5', // Giới hạn số lượng từ 1 đến 5
        ]);

        $quantityAdd = $request->input('quantity_add');
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            if ($quantityAdd <= 0) {
                return redirect()->route('cart.list')->withErrors(['quantity_add' => 'Số lượng phải lớn hơn 0.']);
            }
            $cart[$id]['quantity_add'] = $quantityAdd;
            session(['cart' => $cart]);
            return redirect()->route('cart.list')->with('success', 'Cart updated successfully');
        }

        return redirect()->route('cart.list')->with('error', 'Product not found in cart');
    }

    public function updateMultiple(Request $request)
    {
        $updatedCart = $request->input('updated_cart');
        $cart = session()->get('cart', []);

        $errors = [];

        foreach ($updatedCart as $item) {
            $id = $item['id'];
            $quantityAdd = $item['quantity_add'];

            if ($quantityAdd <= 0 || $quantityAdd > 5) {
                $errors[] = "Số lượng phải từ 1 đến 5 cho sản phẩm ID $id.";
                continue;
            }

            if (isset($cart[$id])) {
                $cart[$id]['quantity_add'] = $quantityAdd;
            }
        }

        if ($errors) {
            return response()->json(['success' => false, 'errors' => $errors]);
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
}
