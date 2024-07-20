<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Exports\OrdersExport;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
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

        $query->orderBy('created_at', 'desc');

        $orders = $query->get();

        return view(self::PATH_VIEW . 'status', compact('orders'));
    }
    public function status(Request $request)
    {
        $query = Order::query();

        $orders = $query->get();

        return view(self::PATH_VIEW . 'status', compact('orders'));
    }

    

    // public function updateMultiple(Request $request)
    // {
    //     try {
    //         $orderIds = $request->input('order_ids', []);
    //         $orders = Order::whereIn('id', $orderIds)->get();

    //         foreach ($orders as $order) {
    //             $currentIndex = array_search($order->status_order, array_keys(Order::STATUS_ORDER));
    //             $newIndex = $currentIndex + 1;

    //             if ($newIndex < count(Order::STATUS_ORDER)) {
    //                 $newStatusOrder = array_keys(Order::STATUS_ORDER)[$newIndex];

    //                 // Check if current status is "delivered" and new status is "canceled"
    //                 if ($order->status_order === 'delivered' && $newStatusOrder === 'canceled') {
    //                     return back()->with('error', 'Không thể chuyển trạng thái sang "Đơn hàng đã bị hủy" nếu đã giao hàng thành công.');
    //                 }

    //                 // Update order status
    //                 $order->status_order = $newStatusOrder;
    //                 $timestampField = $newStatusOrder . '_at';
    //                 $order->$timestampField = Carbon::now('Asia/Ho_Chi_Minh');
    //                 $order->save();
    //             }
    //         }

    //         return redirect()->route('admin.orders.status')->with('success', 'Đã cập nhật trạng thái cho các đơn hàng thành công.');
    //     } catch (\Exception $exception) {
    //         Log::error('Error updating multiple orders: ' . $exception->getMessage());
    //         return back()->with('error', 'Đã xảy ra lỗi khi cập nhật trạng thái cho các đơn hàng. Vui lòng thử lại sau.');
    //     }
    // }

    public function updateMultiple(Request $request)
    {
        try {
            $orderIds = $request->input('order_ids', []);
            $orders = Order::whereIn('id', $orderIds)->get();
            $currentStatus = $request->input('status_order', null);

            foreach ($orders as $order) {
                $currentIndex = array_search($order->status_order, array_keys(Order::STATUS_ORDER));
                $newIndex = $currentIndex + 1;

                if ($newIndex < count(Order::STATUS_ORDER)) {
                    $newStatusOrder = array_keys(Order::STATUS_ORDER)[$newIndex];

                    if ($order->status_order === 'delivered' && $newStatusOrder === 'canceled') {
                        return back()->with('error', 'Không thể chuyển trạng thái sang "Đơn hàng đã bị hủy" nếu đã giao hàng thành công.');
                    }

                    $order->status_order = $newStatusOrder;
                    $timestampField = $newStatusOrder . '_at';
                    $order->$timestampField = Carbon::now('Asia/Ho_Chi_Minh');
                    $order->save();
                }
            }

            return redirect()->route('admin.orders.status', ['status_order' => $currentStatus])->with('success', 'Đã cập nhật trạng thái cho các đơn hàng thành công.');
        } catch (\Exception $exception) {
            Log::error('Error updating multiple orders: ' . $exception->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật trạng thái cho các đơn hàng. Vui lòng thử lại sau.');
        }
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

    public function update(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $statusOrder = $request->input('status_order');
            $statusPayment = $request->input('status_payment');

            // Kiểm tra trạng thái đơn hàng hiện tại
            if ($order->status_order === 'canceled') {
                return back()->with('error', 'Đơn hàng đã bị hủy không thể cập nhật.');
            }

            // Kiểm tra và cập nhật trạng thái đơn hàng
            if ($statusOrder && array_key_exists($statusOrder, Order::STATUS_ORDER)) {
                $currentIndex = array_search($order->status_order, array_keys(Order::STATUS_ORDER));
                $newIndex = array_search($statusOrder, array_keys(Order::STATUS_ORDER));

                // Không cho phép chuyển trạng thái "delivered" thành "canceled"
                if ($order->status_order === 'delivered' && $statusOrder === 'canceled') {
                    return back()->with('error', 'Không thể hủy đơn hàng đã được giao.');
                }

                // Chỉ cho phép cập nhật trạng thái mới nếu trạng thái mới lớn hơn hoặc bằng trạng thái hiện tại
                if ($newIndex >= $currentIndex) {
                    if ($order->status_order !== $statusOrder) {
                        $order->status_order = $statusOrder;

                        // Cập nhật thời gian chuyển trạng thái
                        $timestampField = $statusOrder . '_at';
                        $order->$timestampField = now()->format('Y-m-d H:i:s');
                    }
                } else {
                    return back()->with('error', 'Không thể cập nhật lại trạng thái đơn hàng cũ.');
                }
            }

            // Kiểm tra và cập nhật trạng thái thanh toán
            if ($statusPayment && array_key_exists($statusPayment, Order::STATUS_PAYMENT)) {
                if ($order->status_payment === 'paid' && $statusPayment !== 'paid') {
                    return back()->with('error', 'Đơn hàng đã được thanh toán không thể cập nhật lại trạng thái thanh toán.');
                }

                if ($order->status_payment !== $statusPayment) {
                    $order->status_payment = $statusPayment;
                }
            }

            // Lưu thông tin đơn hàng
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Đã cập nhật trạng thái đơn hàng thành công.');
        } catch (\Exception $exception) {
            Log::error('Error updating order: ' . $exception->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật đơn hàng. Vui lòng thử lại sau.');
        }
    }


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        // $order->orderItems()->delete();
        // foreach ($validated['order_items'] as $item) {
        //     $orderItem = new OrderItem();
        //     $orderItem->fill($item);
        //     $orderItem->order_id = $order->id;
        //     $orderItem->save();
        // }
        return redirect()->route('admin.orders.index')
            ->with('success', 'Đã xóa đơn hàng thành công.');
    }
}
