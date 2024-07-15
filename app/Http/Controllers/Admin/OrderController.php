<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;


use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';


    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('status_order')) {
            $query->where('status_order', $request->status_order);
        }

        if ($request->filled('status_payment')) {
            $query->where('status_payment', $request->status_payment);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        } elseif ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        if ($request->filled('customer_id')) {
            $query->where('user_id', $request->customer_id);
        }

        if ($request->filled('user_name')) {
            $query->where('user_name', 'like', '%' . $request->user_name . '%');
        }

        $orders = $query->get();

        return view(self::PATH_VIEW . 'index', compact('orders'));
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
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
        $order = new Order();
        $order->fill($validated);
        $order->save();

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

        $orderItems = OrderItem::where('order_id', $order->id)->get();
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

        $input = $request->all();

        $order->user_name = $input['user_name'];
        $order->user_email = $input['user_email'];
        $order->user_phone = $input['user_phone'];
        $order->user_address = $input['user_address'];
        $order->total_price = $input['total_price'];

        $order->fill($validated);

        // Cập nhật trạng thái đơn hàng
        if (array_key_exists('status_order', $request->all()) && in_array($request->status_order, array_keys(Order::STATUS_ORDER))) {
            $order->status_order = $request->status_order;
        }

        // Cập nhật trạng thái thanh toán
        if (array_key_exists('status_payment', $request->all()) && in_array($request->status_payment, array_keys(Order::STATUS_PAYMENT))) {
            $order->status_payment = $request->status_payment;
        }

        $order->save();

        $order->orderItems()->delete();
        foreach ($validated['order_items'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->fill($item);
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        return redirect()->route('admin.orders.index')->with('success', 'Đã cập nhật thành công.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Đã xóa đơn hàng thành công.');
    }
}
