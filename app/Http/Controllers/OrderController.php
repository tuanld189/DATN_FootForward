<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function save()
    {
        try {
            DB::transaction(function () {
                // Generate a random user_code
                $userCode = Str::random(10);
                $username = Str::random(8);
                // Create the user with necessary fields
                $user = User::query()->create([
                    'name' => $username,
                    'email' => request('user_email'),
                    'password' => bcrypt(request('user_email')),
                    'username' => request('user_name'),
                    'user_code' => $userCode,
                    'status' => 1,
                ]);
                $totalAmount = 0;
                $dataItem = [];
                foreach (session('cart') as $variantID => $item) {
                    $totalAmount += $item['quantity_add'] * ($item['price'] ?: $item['sale_price']);

                    $dataItem[] = [
                        'product_variant_id' => $variantID,
                        'quantity' => $item['quantity_add'],
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
                $order = Order::query()->create([
                    'user_id' => $user->id,
                    'user_name' => request('user_name'),
                    'user_email' => request('user_email'),
                    'user_phone' => request('user_phone'),
                    'user_address' => request('user_address'),
                    'total_price' => $totalAmount,
                ]);

                // Create order items
                foreach ($dataItem as $item) {
                    $item['order_id'] = $order->id;
                    OrderItem::query()->create($item);
                }
            });

            session()->forget('cart');

            return redirect()->route('users.cart.list')->with('success', 'Đặt hàng thành công');
        } catch (\Exception $exception) {
            dd($exception);
            return back()->with('error', 'Lỗi đặt hàng');
        }
    }
}
