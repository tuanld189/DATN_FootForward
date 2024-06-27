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

            // Initialize $order with an empty Order instance
            $order = new Order();

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
                    'user_id' => Auth::check() ? $request->input('user_id') : $user->id,
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
                // dd($order,$dataItem);
            });



            // Clear the cart after successful order placement
            session()->forget('cart');

            // Redirect to order confirmation page with order_id
            return redirect()->route('order.confirmation', ['order_id' => $order->id]);

        } catch (\Exception $exception) {
            // Handle exceptions
            dd($exception); // Consider logging the exception instead
            return back()->with('error', 'Lỗi đặt hàng');
        }
    }

    public function confirmation($order_id)
    {

        $order = Order::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->get();

        return view('users.order-confirmation', compact('order', 'orderItems'));
    }
}
