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
    public function index()
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
        $topProducts = OrderItem::select(
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
            ->orderByDesc('total_quantity')
            ->take(5) // Lấy 5 sản phẩm bán chạy nhất
            ->get();

        $recentOrders = Order::with('user', 'orderItems')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Lấy các danh mục được mua nhiều nhất và tính phần trăm
        $topCategories = DB::table('order_items')
            ->join('products', 'order_items.product_variant_id', '=', 'products.id')
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
                'topCategories'
            )
        );
    }
    public function RevenueDetail(Request $request)
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
        $totalRevenueDay = Order::where('created_at', '>=', Carbon::now()->subDays(1))->sum('total_price');
        $totalRevenueWeek = Order::where('created_at', '>=', Carbon::now()->subDays(7))->sum('total_price');
        $totalRevenueMonth = Order::where('created_at', '>=', Carbon::now()->subMonth())->sum('total_price');
        $totalRevenueYear = Order::where('created_at', '>=', Carbon::now()->subYear())->sum('total_price');
        $totalRevenueAll = Order::sum('total_price');
        $orders = $query->get();
        $data = Order::query()->latest('id')->paginate(5);

        return view('admin.dashboard.RevenueDetail', compact('orders', 'filter', 'data', 'totalRevenueDay', 'totalRevenueWeek', 'totalRevenueMonth', 'totalRevenueYear', 'totalRevenueAll'));
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

        $query = Order::query(); // or Product::query(), adjust based on your model

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
        $totalProductsWeek = $query->where('created_at', '>=', now()->subWeek())->count();
        $totalProductsMonth = $query->where('created_at', '>=', now()->subMonth())->count();
        $totalProductsYear = $query->where('created_at', '>=', now()->subYear())->count();
        $totalProductsAll = Order::count(); // or Product::count(), adjust based on your model

        return view('admin.dashboard.ProductSoldDetail', compact('soldProducts', 'filter', 'data', 'totalProductsWeek', 'totalProductsMonth', 'totalProductsYear', 'totalProductsAll'));
    }

}
