<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::sum('total_price');
        $totalOrders = Order::count();
        $totalCustomers = User::count();
        // dd(compact('totalRevenue', 'totalOrders', 'totalCustomers'));
        return view('admin.dashboard', compact('totalRevenue', 'totalOrders', 'totalCustomers'));
    }

}
