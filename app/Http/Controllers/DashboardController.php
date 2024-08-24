<?php

namespace App\Http\Controllers;

use App\Models\Order;

use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Tổng số liệu chỉ tính cho đơn hàng đã giao và đã thanh toán
        $totalRevenue = Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
            ->where('status_payment', Order::STATUS_PAYMENT_PAID)
            ->sum('total_price');
        $totalOrders = Order::count();
        $totalCustomers = User::count();

        // Tính tổng số sản phẩm đã bán chỉ khi đơn hàng đã giao và đã thanh toán
        $totalProductsSold = OrderItem::whereHas('order', function ($query) {
            $query->where('status_order', Order::STATUS_ORDER_DELIVERED)
                ->where('status_payment', Order::STATUS_PAYMENT_PAID);
        })->sum('quantity_add');

        // Số liệu theo ngày hiện tại chỉ tính cho đơn hàng đã giao và đã thanh toán
        $today = Carbon::today();
        $totalRevenueToday = Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
            ->where('status_payment', Order::STATUS_PAYMENT_PAID)
            ->whereDate('created_at', $today)
            ->sum('total_price');
        $totalOrdersToday = Order::whereDate('created_at', $today)->count();
        $totalCustomersToday = User::whereDate('created_at', $today)->count();

        // Tính tổng số sản phẩm đã bán hôm nay chỉ khi đơn hàng đã giao và đã thanh toán
        $totalProductsSoldToday = OrderItem::whereHas('order', function ($query) use ($today) {
            $query->where('status_order', Order::STATUS_ORDER_DELIVERED)
                ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                ->whereDate('created_at', $today);
        })->sum('quantity_add');

        // Biểu đồ thống kê theo ngày
        $daysRange = 12;
        $dates = collect();
        $totalOrdersPerDay = collect();
        $totalRevenuePerDay = collect();
        $totalCustomersPerDay = collect();
        $totalProductsSoldPerDay = collect();

        for ($i = 0; $i < $daysRange; $i++) {
            $date = $today->copy()->subDays($i)->format('Y-m-d');
            $dates->prepend($date); // Sắp xếp từ ngày cũ nhất đến ngày mới nhất

            $totalOrdersPerDay->prepend(Order::whereDate('created_at', $date)->count());
            $totalRevenuePerDay->prepend(Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                ->whereDate('created_at', $date)
                ->sum('total_price'));
            $totalCustomersPerDay->prepend(User::whereDate('created_at', $date)->count());

            // Tính tổng số sản phẩm đã bán theo ngày chỉ khi đơn hàng đã giao và đã thanh toán
            $totalProductsSoldPerDay->prepend(OrderItem::whereHas('order', function ($query) use ($date) {
                $query->where('status_order', Order::STATUS_ORDER_DELIVERED)
                    ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                    ->whereDate('created_at', $date);
            })->sum('quantity_add'));
        }

        // Truy vấn sản phẩm bán chạy nhất
        $filter = $request->input('filter', 'today');

        $topProductsQuery = OrderItem::select(
            'product_variant_id',
            'product_name',
            'product_image',
            'product_price',
            'product_sale_price',
            'variant_size_name',
            'variant_color_name',
            DB::raw('SUM(quantity_add) as total_quantity')
        )
            ->groupBy('product_variant_id', 'product_name', 'product_image', 'product_price', 'product_sale_price', 'variant_size_name', 'variant_color_name')
            ->orderByDesc('total_quantity');

        // Apply date filter
        if ($filter === 'today') {
            $topProductsQuery->whereDate('created_at', Carbon::today());
        } elseif ($filter === '7days') {
            $topProductsQuery->whereDate('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($filter === '1month') {
            $topProductsQuery->whereDate('created_at', '>=', Carbon::now()->subMonth());
        }

        $topProducts = $topProductsQuery->take(5)->get();

        $recentOrders = Order::with('user', 'orderItems')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Lấy các danh mục được mua nhiều nhất và tính phần trăm
        $topCategories = DB::table('order_items')
            ->join('products', 'order_items.product_sku', '=', 'products.sku')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('SUM(order_items.quantity_add) as total_quantity'))
            ->groupBy('categories.name')
            ->orderBy('total_quantity', 'desc')
            ->get();

        // Tính phần trăm
        $topCategories->transform(function ($category) use ($totalProductsSold) {
            $category->percentage = round(($category->total_quantity / $totalProductsSold) * 100, 2);
            return $category;
        });

        return view(
            'admin.dashboard.Dashboard',
            compact(
                'totalRevenue',
                'totalOrders',
                'totalCustomers',
                'totalProductsSold',
                'totalRevenueToday',
                'totalOrdersToday',
                'totalCustomersToday',
                'totalProductsSoldToday',
                'dates',
                'totalOrdersPerDay',
                'totalRevenuePerDay',
                'totalCustomersPerDay',
                'totalProductsSoldPerDay',
                'topProducts',
                'recentOrders',
                'topCategories',
                'filter'
            )
        );
    }
    public function RevenueDetail(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $startDate = null;
        $endDate = null;
        $labels = collect();
        $totalRevenuePerDay = collect();

        switch ($filter) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                $labels = collect(range(0, 23)); // 24 hours
                $totalRevenuePerDay = $labels->map(function ($hour) use ($startDate) {
                    return Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                        ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                        ->whereBetween('created_at', [$startDate->copy()->hour($hour)->startOfHour(), $startDate->copy()->hour($hour)->endOfHour()])
                        ->sum('total_price');
                });
                break;
            case 'yesterday':
                $startDate = now()->subDay()->startOfDay();
                $endDate = now()->subDay()->endOfDay();
                $labels = collect(range(0, 23)); // 24 hours
                $totalRevenuePerDay = $labels->map(function ($hour) use ($startDate) {
                    return Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                        ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                        ->whereBetween('created_at', [$startDate->copy()->hour($hour)->startOfHour(), $startDate->copy()->hour($hour)->endOfHour()])
                        ->sum('total_price');
                });
                break;
            case 'this_week':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                $labels = collect(range(0, 6))->map(function ($day) use ($startDate) {
                    return $startDate->copy()->addDays($day)->format('d/m');
                });
                $totalRevenuePerDay = $labels->map(function ($label, $day) use ($startDate) {
                    return Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                        ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                        ->whereDate('created_at', $startDate->copy()->addDays($day)->format('Y-m-d'))
                        ->sum('total_price');
                });
                break;
            case 'this_month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $labels = collect(range(0, 3))->map(function ($week) use ($startDate) {
                    return $startDate->copy()->addWeeks($week)->format('d/m') . ' - ' . $startDate->copy()->addWeeks($week + 1)->subDay()->format('d/m');
                });
                $totalRevenuePerDay = $labels->map(function ($weekLabel, $week) use ($startDate) {
                    return Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                        ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                        ->whereBetween('created_at', [$startDate->copy()->addWeeks($week)->startOfWeek(), $startDate->copy()->addWeeks($week)->endOfWeek()])
                        ->sum('total_price');
                });
                break;
            case 'this_year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $labels = collect(range(1, 12))->map(function ($month) use ($startDate) {
                    return $startDate->copy()->month($month)->format('F');
                });
                $totalRevenuePerDay = $labels->map(function ($month, $index) use ($startDate) {
                    return Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                        ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                        ->whereYear('created_at', $startDate->year)
                        ->whereMonth('created_at', $index + 1)
                        ->sum('total_price');
                });
                break;
            case 'custom':
                $startDate = $request->query('start_date', now()->startOfMonth());
                $endDate = $request->query('end_date', now()->endOfMonth());

                $startDate = Carbon::parse($startDate);
                $endDate = Carbon::parse($endDate);

                $daysRange = $endDate->diffInDays($startDate) + 1;
                $labels = collect(range(0, $daysRange - 1))->map(function ($day) use ($startDate) {
                    return $startDate->copy()->addDays($day)->format('d/m');
                });
                $totalRevenuePerDay = $labels->map(function ($label, $day) use ($startDate) {
                    return Order::where('status_order', Order::STATUS_ORDER_DELIVERED)
                        ->where('status_payment', Order::STATUS_PAYMENT_PAID)
                        ->whereDate('created_at', $startDate->copy()->addDays($day)->format('Y-m-d'))
                        ->sum('total_price');
                });
                break;
            default:
                // Handle default case, you may need to set some fallback values
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
        }

        if (is_null($startDate) || is_null($endDate)) {
            return back()->with('error', 'Ngày bắt đầu hoặc kết thúc không hợp lệ.');
        }

        $query = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status_order', Order::STATUS_ORDER_DELIVERED)
            ->where('status_payment', Order::STATUS_PAYMENT_PAID);

        $totalRevenueAll = $query->sum('total_price');
        $totalOrders = $query->count();
        $totalCancelledOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status_order', Order::STATUS_ORDER_CANCELED)
            ->count();

        $orders = $query->latest('id')->paginate(5);

        return view('admin.dashboard.RevenueDetail', compact(
            'orders',
            'filter',
            'totalRevenueAll',
            'totalOrders',
            'totalCancelledOrders',
            'labels',
            'totalRevenuePerDay'
        ));
    }
    public function OrderDetail(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = Order::query();

        if ($filter == '1day') {
            $query->where('created_at', '>=', Carbon::now()->subDay());
        } elseif ($filter == '7days') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($filter == '1month') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        } elseif ($filter == '1year') {
            $query->where('created_at', '>=', Carbon::now()->subYear());
        }

        $orders = $query->get();
        $data = Order::query()->latest('id')->paginate(5);

        $totalOrdersWeek = Order::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $totalOrdersMonth = Order::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $totalOrdersYear = Order::where('created_at', '>=', Carbon::now()->subYear())->count();
        $totalOrdersAll = Order::count();

        return view('admin.dashboard.OrderDetail', compact('orders', 'filter', 'data', 'totalOrdersWeek', 'totalOrdersMonth', 'totalOrdersYear', 'totalOrdersAll'));
    }
    public function UserDetail(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = User::query();

        if ($filter == '1day') {
            $query->where('created_at', '>=', Carbon::now()->subDay());
        } elseif ($filter == '7days') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($filter == '1month') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        } elseif ($filter == '1year') {
            $query->where('created_at', '>=', Carbon::now()->subYear());
        }

        $users = $query->get();
        $data = User::query()->latest('id')->paginate(5);
        $totalUsersWeek = User::where('created_at', '>=', now()->subWeek())->count();
        $totalUsersMonth = User::where('created_at', '>=', now()->subMonth())->count();
        $totalUsersYear = User::where('created_at', '>=', now()->subYear())->count();
        $totalUsersAll = User::count();


        return view('admin.dashboard.UserDetail', compact('users', 'filter', 'data', 'totalUsersWeek', 'totalUsersMonth', 'totalUsersYear', 'totalUsersAll'));
    }
    public function ProductSoldDetail(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = OrderItem::query();

        if ($filter == '1day') {
            $query->where('created_at', '>=', Carbon::now()->subDay());
        } elseif ($filter == '7days') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($filter == '1month') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        } elseif ($filter == '1year') {
            $query->where('created_at', '>=', Carbon::now()->subYear());
        }

        $soldProducts = $query->get();
        $data = $query->latest('id')->paginate(5);

        $totalProductsWeek = OrderItem::where('created_at', '>=', now()->subWeek())->sum('quantity_add');
        $totalProductsMonth = OrderItem::where('created_at', '>=', now()->subMonth())->sum('quantity_add');
        $totalProductsYear = OrderItem::where('created_at', '>=', now()->subYear())->sum('quantity_add');
        $totalProductsAll = OrderItem::sum('quantity_add');

        return view('admin.dashboard.ProductSoldDetail', compact('soldProducts', 'filter', 'data', 'totalProductsWeek', 'totalProductsMonth', 'totalProductsYear', 'totalProductsAll'));
    }
}
