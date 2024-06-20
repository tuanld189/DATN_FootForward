<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function list()
    {
        $cart = session('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['quantity_add'] * ($item['price'] ?: $item['sale_price']);
        }

        return view('users.cart-list', compact('cart', 'totalAmount'));
    }

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

        if (isset($cart[$productVariant->id])) {
            $cart[$productVariant->id]['quantity_add'] += $request->quantity_add;
        } else {
            // Include all relevant product details in the cart
            $cart[$productVariant->id] = [
                'id' => $productVariant->id,
                'name' => $product->name,
                'image' => $product->img_thumbnail,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
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
        return redirect()->route('users.cart.list');
    }

    public function update(Request $request, $id)
    {
        // Lấy giỏ hàng từ session
        $cart = session('cart', []);

        // Kiểm tra sản phẩm có trong giỏ hàng hay không
        if (isset($cart[$id])) {
            // Cập nhật số lượng sản phẩm
            $cart[$id]['quantity_add'] = $request->input('quantity_add');

            // Lưu lại giỏ hàng vào session
            session(['cart' => $cart]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }


    public function updateMultiple(Request $request)
    {
        $updatedCart = $request->input('updated_cart');

        // Validate and process $updatedCart as needed
        // Example: save updated cart to session or database

        // For demonstration, we update the session cart
        session()->put('cart', $updatedCart);

        return response()->json(['success' => true]);
    }
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('users.cart.list');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['quantity_add'] * ($item['price'] ?: $item['price_sale']);
        }

        return view('users.cart-checkout', compact('cart', 'totalAmount'));
    }
}
