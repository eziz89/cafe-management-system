<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(5);

        return view('orders.my-orders', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems.dish');

        return view('orders.show', compact('order'));
    }

    public function reorder(Order $order)
    {
        $cart = [];

        foreach ($order->orderItems as $item) {

            $cart[$item->dish_id] = [
                'name' => $item->dish->name,
                'price' => $item->dish->price,
                'image' => $item->dish->image,
                'quantity' => $item->quantity,
            ];
        }

        session()->put('cart', $cart);

        session([
            'checkout' => [
                'customer_name' => $order->customer_name,
                'customer_phone' => $order->customer_phone,
                'customer_address' => $order->customer_address,
                'order_type' => $order->order_type,
                'payment_method' => $order->payment_method,
                'notes' => $order->notes,
                'reorder_from' => $order->id,
            ],
        ]);

        return redirect()->route('cart.index')->with('success', 'Order added to cart again.');
    }

    public function status(Order $order)
    {
        return response()->json([
            'timeline' => view('orders.partials.timeline', [
                'order' => $order
            ])->render(),

            'badge' => view('orders.partials.badge', [
                'order' => $order
            ])->render(),

        ]);
    }

    public function statuses()
    {
        $orders = Order::where('user_id', Auth::id())->get();
    
        $statuses = $orders->map(function ($order) {
        
            return [
                'id' => $order->id,
            
                'badge' => view('orders.partials.badge', [
                    'order' => $order,
                ])->render(),
            ];
        
        });
    
        return response()->json($statuses);
    }
}
