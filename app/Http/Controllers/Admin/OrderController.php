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


    public function index(Request $request)
    {
        $query = Order::query();

        // Lọc theo trạng thái đơn hàng
        if ($request->filled('status_order')) {
            $query->where('status_order', $request->status_order);
        }

        // Lọc theo trạng thái thanh toán
        if ($request->filled('status_payment')) {
            $query->where('status_payment', $request->status_payment);
        }

        // Lọc theo khoảng thời gian
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        } elseif ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from);
        } elseif ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to);
        }

        // Lọc theo customer_id
        if ($request->filled('customer_id')) {
            $query->where('user_id', $request->customer_id);
        }

        // Lọc theo user_name
        if ($request->filled('user_name')) {
            $query->where('user_name', 'like', '%' . $request->user_name . '%');
        }

        $orders = $query->get();

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



    public function update(Request $request, $id)
    {
        // Lấy thông tin đơn hàng từ ID
        $order = Order::findOrFail($id);

        // Lấy dữ liệu từ request
        $input = $request->all();

        // Kiểm tra và cập nhật các thuộc tính của đơn hàng
        $order->user_name = $input['user_name'];
        $order->user_email = $input['user_email'];
        $order->user_phone = $input['user_phone'];
        $order->user_address = $input['user_address'];
        $order->total_price = $input['total_price'];


        // Kiểm tra xem giá trị status_order được gửi từ form có phù hợp hay không
        if (array_key_exists('status_order', $input) && in_array($input['status_order'], array_keys(Order::STATUS_ORDER))) {
            $order->status_order = $input['status_order'];
        }

        // Kiểm tra xem giá trị status_payment được gửi từ form có phù hợp hay không
        if (array_key_exists('status_payment', $input) && in_array($input['status_payment'], array_keys(Order::STATUS_PAYMENT))) {
            $order->status_payment = $input['status_payment'];
        }

        // Lưu lại các thay đổi
        $order->save();

        // Redirect hoặc trả về view sau khi cập nhật thành công
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập nhật thành công.');
    }

    // }
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete();
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Đã xóa đơn hàng thành công.');
    }
}
