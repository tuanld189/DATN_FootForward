<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function list()
    {
        $cart = Order::all();
        $cart = session('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['quantity_add'] * ($item['price'] ?: $item['sale_price']);
        }

        return view('client.cart-list', compact('cart', 'totalAmount'));
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

    public function checkout()
    {

        $cart = session()->get('cart', []);
        $totalAmount = 0;

        foreach ($cart as $item) {
            $totalAmount += $item['quantity_add'] * ($item['price'] ?: $item['price_sale']);
        }

        return view('client.cart-checkout', compact('cart', 'totalAmount'));
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
