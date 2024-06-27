<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';

    public function index()
    {
        $orders = Order::latest()->paginate(10);

        return view(self::PATH_VIEW . 'index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view(self::PATH_VIEW . 'create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:20',
            'user_address' => 'required|string|max:255',
            'user_note' => 'nullable|string',
            'is_ship_user_same_user' => 'required|boolean',
            'ship_user_name' => 'nullable|string|max:255',
            'ship_user_email' => 'nullable|email|max:255',
            'ship_user_phone' => 'nullable|string|max:20',
            'ship_user_address' => 'nullable|string|max:255',
            'ship_user_note' => 'nullable|string',
            'status_order' => 'required|string|max:50',
            'status_payment' => 'required|string|max:50',
            'total_price' => 'required|numeric',
            'order_items' => 'required|array',
            'order_items.*.product_variant_id' => 'required|integer',
            'order_items.*.quantity_add' => 'required|integer',
            'order_items.*.product_name' => 'required|string|max:255',
            'order_items.*.product_sku' => 'required|string|max:100',
            'order_items.*.product_image' => 'required|string|max:255',
            'order_items.*.product_price' => 'required|numeric',
            'order_items.*.product_sale_price' => 'nullable|numeric',
            'order_items.*.variant_size_name' => 'nullable|string|max:100',
            'order_items.*.variant_color_name' => 'nullable|string|max:100',
        ]);
        $users = User::all();
        // Tạo order mới
        $order = new Order();
        $order->fill($validated);
        $order->save();

        // Tạo các order item
        foreach ($validated['order_items'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->fill($item);
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        return redirect()->route('admin.orders.index')->with('success', 'Đã tạo đơn hàng thành công.');
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get(); // Sử dụng $order->id thay vì $orderId

        return view(self::PATH_VIEW . 'show', compact('order', 'orderItems'));
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        $products = Product::all();
        $orderItems = $order->orderItems;
        return view(self::PATH_VIEW . 'edit', compact('order', 'orderItems', 'users', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|string|max:20',
            'user_address' => 'required|string|max:255',
            'user_note' => 'nullable|string',
            'is_ship_user_same_user' => 'required|boolean',
            'ship_user_name' => 'nullable|string|max:255',
            'ship_user_email' => 'nullable|email|max:255',
            'ship_user_phone' => 'nullable|string|max:20',
            'ship_user_address' => 'nullable|string|max:255',
            'ship_user_note' => 'nullable|string',
            'status_order' => 'required|string|max:50',
            'status_payment' => 'required|string|max:50',
            'total_price' => 'required|numeric',
            'order_items' => 'required|array',
            'order_items.*.product_variant_id' => 'required|integer',
            'order_items.*.quantity_add' => 'required|integer',
            'order_items.*.product_name' => 'required|string|max:255',
            'order_items.*.product_sku' => 'required|string|max:100',
            'order_items.*.product_image' => 'required|string|max:255',
            'order_items.*.product_price' => 'required|numeric',
            'order_items.*.product_sale_price' => 'nullable|numeric',
            'order_items.*.variant_size_name' => 'nullable|string|max:100',
            'order_items.*.variant_color_name' => 'nullable|string|max:100',
        ]);

        // Cập nhật order
        $order->fill($validated);
        $order->save();

        // Xóa các order item cũ và tạo lại
        $order->orderItems()->delete();
        foreach ($validated['order_items'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->fill($item);
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        return redirect()->route('admin.orders.index')->with('success', 'Đã tạo đơn hàng thành công.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đã xóa đơn hàng thành công.');
    }

}
