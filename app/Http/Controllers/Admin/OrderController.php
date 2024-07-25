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
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';


    public function index(Request $request)
    {
        $query = Order::query()->orderBy('id', 'desc');

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

        $orders = $query->paginate(7);

        return view(self::PATH_VIEW . 'index', compact('orders'));
    }


    public function status(Request $request)
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

        $orders = $query->paginate(7);




        return view(self::PATH_VIEW . 'status', compact('orders'));
    }

    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
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
            // Tìm đơn hàng theo ID
            $order = Order::findOrFail($id);

            // Nhận dữ liệu trạng thái từ yêu cầu
            $statusOrder = $request->input('status_order');
            $statusPayment = $request->input('status_payment');

            // Kiểm tra trạng thái thanh toán
            if ($statusPayment && array_key_exists($statusPayment, Order::STATUS_PAYMENT)) {
                // Nếu đơn hàng đã thanh toán, không cho phép thay đổi trạng thái thanh toán
                if ($order->status_payment === 'paid' && $statusPayment !== 'paid') {
                    return back()->with('error', 'Đơn hàng đã được thanh toán không thể cập nhật lại trạng thái thanh toán.');
                }

                // Luôn cập nhật trạng thái thanh toán thành 'paid' nếu có dữ liệu từ yêu cầu
                $order->status_payment = $statusPayment;
            } else {
                // Nếu không có trạng thái thanh toán từ yêu cầu, tự động đặt thành 'paid'
                $order->status_payment = 'paid';
            }

            // Cập nhật trạng thái đơn hàng
            if ($statusOrder && array_key_exists($statusOrder, Order::STATUS_ORDER)) {
                $currentIndex = array_search($order->status_order, array_keys(Order::STATUS_ORDER));
                $newIndex = array_search($statusOrder, array_keys(Order::STATUS_ORDER));

                // Không cho phép hủy đơn hàng đã thanh toán hoặc đã giao
                if ($order->status_payment === 'paid' || $order->status_order === 'delivered') {
                    if ($statusOrder === 'canceled') {
                        return back()->with('error', 'Không thể hủy đơn hàng đã thanh toán hoặc đã giao.');
                    }
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

            // Lưu thông tin đơn hàng
            $order->save();

            return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công.');
        } catch (\Exception $exception) {
            // Ghi log lỗi
            Log::error('Error updating order: ' . $exception->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi khi cập nhật đơn hàng. Vui lòng thử lại sau.');
        }
    }


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



}
