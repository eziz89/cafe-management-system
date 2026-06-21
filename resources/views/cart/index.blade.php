@extends('layouts.app')

@section('content')

    <section class="bg-stone-100 min-h-screen py-20">

        <div class="max-w-7xl mx-auto">
            <div class="mb-16">
                <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold mb-4">
                    {{ __('cart.order') }}
                </p>
                <h1 class="text-5xl font-bold mb-6">
                    {{ __('cart.order_title') }}
                </h1>
                <p class="text-stone-500 text-lg max-w-2xl">
                    {{ __('cart.order_description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div id="cart-items" class="lg:col-span-2 space-y-6">

                    @include('partials.cart-items')
                    
                </div>

                <div>
                    <div class="bg-white shadow-lg rounded-3xl p-8 sticky top-28">

                        <h2 class="text-3xl text-neutral-900 font-bold mb-6">
                            {{ __('cart.summary') }}
                        </h2>
                        <div class="flex justify-between text-gray-500 mb-6">
                            <span>{{ __('cart.total_items') }}</span>
                            <span id="cart-items-count">
                                {{ count($cart) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-neutral-800 text-2xl font-bold mb-10">

                            <span>{{ __('cart.total') }}</span>
                            <span id="cart-total">
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
                                    text-white py-3 rounded-2xl
                                    font-semibold transition duration-300">

                                {{ __('cart.checkout') }}
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