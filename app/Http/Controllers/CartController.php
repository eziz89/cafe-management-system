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

        if ($dish->status !== 'available') {

            return back()->with(
                'error',
                'This dish is currently unavailable.'
            );
        }

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

        return $this->cartResponse($cart, $id);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if(empty($cart)) {
            return redirect('/cart');
        }
        
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $phone = preg_replace('/\D/', '', $request->customer_phone);

        if (str_starts_with($phone, '993')) {
            $phone = '+' . $phone;
        } else {
            $phone = '+993' . $phone;
        }
        
        $request->merge([
            'customer_phone' => $phone,
        ]);

        $request->validate([
            'customer_name' => [
                'required',
                'string',
                'max:255'
            ],
        
            'customer_phone' => [
                'required',
                'regex:/^\+993[0-9]{8}$/',
            ],
        
            'order_type' => [
                'required',
                'in:delivery,takeaway,eat_in',
            ],

            'payment_method' => [
                'required',
                'in:cash,card',
            ],

            'customer_address' => [
                'required_if:order_type,delivery',
                'nullable',
                'string',
                'max:500',
            ],

            'notes' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ], [
            'customer_name.required' => 'Please enter your name.',
            'customer_phone.required' => 'Please enter your phone number.',
            'customer_phone.regex' => 'Please enter a valid Turkmen phone number.',
            'notes.max' => 'Notes cannot be longer than 1000 characters.',
        ]);
            
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'customer_name' => $request->customer_name,
            'customer_phone'=> $request->customer_phone,
            'order_type' => $request->order_type,
            'payment_method' => $request->payment_method,
            'customer_address'=> $request->customer_address,
            'notes' => $request->notes,
            'total_price' => $total,
            'status' => 'pending',
            'reordered_from_id' => session('reorder_from'),
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
        session()->forget('checkout');
        session()->forget('reorder_from');

        return redirect()->route('checkout.success', $order);
    }

    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('checkout.index', compact('cart', 'total'));
    }

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['success' => false], 404);
        }

        $cart[$id]['quantity']++;

        session()->put('cart', $cart);

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

        $cartHtml = view('cart.items', [
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
