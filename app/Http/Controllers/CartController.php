<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $dish = Dish::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $dish->name,
                'price' => $dish->price,
                'image' => $dish->image,
                'quantity' => 1    
            ];
        }

        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.index', compact('cart', 'total'));
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $cartHtml = view('partials.cart-items', [
            'cart' => $cart,
        ])->render();


        return $this->cartResponse($cart, $id);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect('/cart');
        }
        
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $total,
            'status' => 'pending',
        ]);

        foreach($cart as $dishId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'dish_id' => $dishId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.success');
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false], 404);
        }

        $cart[$id]['quantity']++;

        session()->put('cart', $cart);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $cartHtml = view('partials.cart-items', [
            'cart' => $cart,
        ])->render();

        return $this->cartResponse($cart, $id);
    }

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false], 404);
        }

        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $cartHtml = view('partials.cart-items', [
            'cart' => $cart,
        ])->render();

        return $this->cartResponse($cart, $id);
    }

    public function count()
    {
        $cart = session()->get('cart', []);

        return response()->json([
            'count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    private function cartResponse(array $cart, $id = null)
    {
        $totalItems = array_sum(array_column($cart, 'quantity'));

        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }   

        $cartHtml = view('partials.cart-items', [
            'cart' => $cart,
        ])->render();

        return response()->json([
            'success' => true,
            'quantity' => $id && isset($cart[$id]) ? $cart[$id]['quantity'] : 0,
            'total_items' => $totalItems,
            'total_price' => number_format($totalPrice, 2),
            'cart_count' => $totalItems,
            'removed' => $id ? !isset($cart[$id]) : false,
            'empty' => empty($cart),
            'cart_html' => $cartHtml,
        ]);
    }


}
