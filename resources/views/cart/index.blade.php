@extends('layouts.app')

@section('content')

    <section class="bg-stone-100 min-h-screen py-20">

        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold mb-4">
                    Your Order
                </p>
                <h1 class="text-5xl font-bold text-black mb-6">
                    Shopping Cart
                </h1>
                <p class="text-stone-500 text-lg max-w-2xl">
                    Review your selected dishes before proceeding to checkout.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-6">
                        @forelse($cart as $id => $item)
                            <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-6 flex gap-6 items-center">
                                <img src="{{ asset('storage/' . $item['image']) }}" class="w-32 h-32 object-cover rounded-2xl">

                                <div class="flex-1">
                                    <div class="flex justify-between mb-8">
                                        <h2 class="text-2xl font-bold text-white">
                                            {{ $item['name'] }}
                                        </h2>
                                        <span class="text-orange-400 font-bold text-xl">
                                            ${{ $item['price'] }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between">

                                        <form action="{{ route('cart.remove', $id) }}"
                                              method="POST">
                                            @csrf

                                            <button class="text-red-400  hover:text-red-300 transition">
                                                Remove Item
                                            </button>
                                        </form>
                                        <div class="flex items-center gap-3">
                                            <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                                @csrf

                                                <button class="w-8 h-8 rounded-full bg-stone-200 hover:bg-stone-300 font-bold">
                                                    -
                                                </button>
                                            </form>

                                            <span class="text-lg text-white font-semibold">
                                                {{ $item['quantity'] }}
                                            </span>

                                            <form action="{{ route('cart.increase', $id) }}" method="POST">
                                                @csrf

                                                <button class="w-8 h-8 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold">
                                                    +
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @empty

                            <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                                <h2 class="text-3xl font-bold mb-4">
                                    Your cart is empty
                                </h2>   
                                <p class="text-gray-500 mb-8">
                                    Explore our delicious menu and add dishes.
                                </p>
                                <a href="/menu" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-semibold">
                                    Browse Menu
                                </a>
                            </div>

                        @endforelse
                </div>

                <div>
                    <div class="bg-neutral-900 border border-neutral-800 rounded-3xl p-8 sticky top-28">

                        <h2 class="text-3xl font-bold text-white mb-8">
                            Order Summary
                        </h2>
                        <div class="flex justify-between text-neutral-300 mb-6">
                            <span>Total Items</span>
                            <span>
                                {{ count($cart) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-white text-2xl font-bold mb-10">

                            <span>Total</span>
                            <span>
                                ${{ $total }}
                            </span>
                        </div>

                        @auth

                        <form action="{{ route('checkout') }}" method="POST">
                            @csrf

                            <button type="submit" 
                                class="block text-center w-full
                                    bg-orange-500 hover:bg-orange-600
                                    hover:shadow-lg hover:shadow-orange-500/30
                                    text-white py-4 rounded-2xl
                                    font-semibold transition duration-300">

                                Proceed to Checkout
                            </button>
                        </form>

                        @else

                        <a href="{{ route('login') }}" class="w-full bg-gray-800 text-white text-center font-semibold px-6 py-3 rounded-xl inline-block">
                            Login to Order
                        </a>

                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection