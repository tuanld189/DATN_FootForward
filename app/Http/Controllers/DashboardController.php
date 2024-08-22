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
        // Tổng số liệu
        $totalRevenue = Order::sum('total_price');
        $totalOrders = Order::count();
        $totalCustomers = User::count();
        $totalProductsSold = OrderItem::sum('quantity_add');

        // Số liệu theo ngày hiện tại
        $today = Carbon::today();
        $totalRevenueToday = Order::whereDate('created_at', $today)->sum('total_price');
        $totalOrdersToday = Order::whereDate('created_at', $today)->count();
        $totalCustomersToday = User::whereDate('created_at', $today)->count();
        $totalProductsSoldToday = OrderItem::whereDate('created_at', $today)->sum('quantity_add');

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
            $totalRevenuePerDay->prepend(Order::whereDate('created_at', $date)->sum('total_price'));
            $totalCustomersPerDay->prepend(User::whereDate('created_at', $date)->count());
            $totalProductsSoldPerDay->prepend(OrderItem::whereDate('created_at', $date)->sum('quantity_add'));
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

        // dd($topCategories);

        return view('admin.dashboard.Dashboard',
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
                'topProducts', // Truyền biến $topProducts đến view
                'recentOrders', // Truyền biến $recentOrders đến view
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
        $data = collect();

        switch ($filter) {
            case 'today':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                $labels = collect(range(0, 23)); // 24 giờ
                $data = collect(range(0, 23))->map(function ($hour) use ($startDate) {
                    return Order::whereDate('created_at', $startDate)
                        ->whereBetween('created_at', [$startDate->copy()->hour($hour)->startOfHour(), $startDate->copy()->hour($hour)->endOfHour()])
                        ->sum('total_price');
                });
                break;
            case 'yesterday':
                $startDate = now()->subDay()->startOfDay();
                $endDate = now()->subDay()->endOfDay();
                $labels = collect(range(0, 23)); // 24 giờ
                $data = collect(range(0, 23))->map(function ($hour) use ($startDate) {
                    return Order::whereDate('created_at', $startDate)
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
                $data = $labels->map(function ($date) use ($startDate) {
                    return Order::whereDate('created_at', $startDate->copy()->format('Y-m-d'))
                        ->sum('total_price');
                });
                break;
            case 'this_month':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $labels = collect(range(0, 3))->map(function ($week) use ($startDate) {
                    return $startDate->copy()->addWeeks($week)->format('d/m') . ' - ' . $startDate->copy()->addWeeks($week + 1)->subDay()->format('d/m');
                });
                $data = $labels->map(function ($weekLabel) use ($startDate) {
                    return Order::whereBetween('created_at', [$startDate->copy()->startOfWeek(), $startDate->copy()->endOfWeek()])
                        ->sum('total_price');
                });
                break;
            case 'this_year':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $labels = collect(range(1, 12))->map(function ($month) use ($startDate) {
                    return $startDate->copy()->month($month)->format('F');
                });
                $data = $labels->map(function ($month) use ($startDate) {
                    return Order::whereYear('created_at', $startDate->year)
                        ->whereMonth('created_at', $startDate->month)
                        ->sum('total_price');
                });
                break;
            case 'custom':
                $startDate = $request->query('start_date', now()->startOfMonth());
                $endDate = $request->query('end_date', now()->endOfMonth());

                // Chuyển đổi thành đối tượng Carbon nếu chưa phải
                $startDate = Carbon::parse($startDate);
                $endDate = Carbon::parse($endDate);

                // Xử lý khoảng thời gian tùy chỉnh
                $daysRange = $endDate->diffInDays($startDate) + 1;
                $dates = collect();
                $totalRevenuePerDay = collect();
                for ($i = 0; $i < $daysRange; $i++) {
                    $date = $startDate->copy()->addDays($i)->format('Y-m-d');
                    $dates->push($date);
                    $totalRevenuePerDay->push(Order::whereDate('created_at', $date)->sum('total_price'));
                }

                break;
        }

        $query = Order::whereBetween('created_at', [$startDate, $endDate]);

        $totalRevenueAll = $query->sum('total_price');
        $totalOrders = $query->count();
        $totalCancelledOrders = $query->whereNotNull('canceled_at')->count();

        $daysRange = $endDate->diffInDays($startDate) + 1;
        $dates = collect();
        $totalRevenuePerDay = collect();
        $orders = $query->get();

        for ($i = 0; $i < $daysRange; $i++) {
            $date = $startDate->copy()->addDays($i)->format('Y-m-d');
            $dates->push($date);

            $totalRevenuePerDay->push(Order::whereDate('created_at', $date)->sum('total_price'));
        }

        $data = $query->latest('id')->paginate(5);

        return view('admin.dashboard.RevenueDetail', compact(
            'orders',
            'filter',
            'data',
            'totalRevenueAll',
            'totalOrders',
            'totalCancelledOrders',
            'dates',
            'totalRevenuePerDay',
            'labels', // Ensure labels are also passed for custom range
            'data'
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
