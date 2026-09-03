<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Notification;
use App\Services\NotificationService;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $this->getOrders($request)->latest()->paginate(5)->withQueryString();
    
        $counters = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
    
        // AJAX requests only need the table
        if ($request->ajax()) {
            return view(
                'admin.orders.partials.table',
                compact('orders')
            );
        }
    
        // Normal page request gets the complete page
        return view(
            'admin.orders.index',
            compact('orders', 'counters')
        );
    }

    public function updateStatus(Request $request, Order $order, NotificationService $notifications)
    {
        $oldStatus = $order->status;
        
        $order->update([
            'status' => $request->status,
        ]);

        $order->refresh();

        if ($oldStatus !== $order->status) {
            $notifications->orderStatusChanged($order);
        }

        $counters = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'preparing' => Order::where('status', 'preparing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
        
        return response()->json([
            'success' => true,
            'status' => $order->status,
            'counters' => $counters,
                
            'actions' => view(
                'admin.orders.partials.actions',
                compact('order')
            )->render(),
        ]);
    }

    private function getOrders(Request $request)
    {
        $query = Order::with([
            'user',
            'orderItems.dish'
        ]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%");
                  });

            });
        }

        return $query;
    }

    public function live(Request $request)
    {
        $orders = $this->getOrders($request)->latest()->paginate(5)->withQueryString();

        return view(
            'admin.orders.partials.table',
            compact('orders')
        );
    }
}
