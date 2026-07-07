<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Dish;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $stats = [
            'todayOrders' => Order::whereDate('created_at', $today)->count(),

            'todayRevenue' => Order::whereDate('created_at', $today)
                ->where('status', 'completed')
                ->sum('total'),

            'pendingOrders' => Order::where('status', 'pending')->count(),

            'availableDishes' => Dish::where('status', 'available')->count(),

            'comingSoonDishes' => Dish::where('status', 'coming_soon')->count(),

            'outOfStockDishes' => Dish::where('status', 'out_of_stock')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
