<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();

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
        foreach ($order->orderItems as $item)
        {
            $cart = session()->get('cart', []);

            if(isset($cart[$item->dish_id])) {
                $cart[$item->dish_id]['quantity'] += $item->quantity;
            } else {
                $cart[$item->dish_id] = [
                    'name' => $item->dish->name,
                    'price' => $item->dish->price,
                    'image' => $item->dish->image,
                    'quantity' => $item->dish->quantity,
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Order added cart to cart again.');
    }
}
