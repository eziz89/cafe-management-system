@extends('layouts.app')

@section('content')

    <section class="bg-gray-50 py-10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
            
            <div class="sm:mb-8 mb-4">

                <p class="text-orange-400 uppercase tracking-[0.3em] font-semibold mb-4">
                    {{ __('cart.order') }}
                </p>

                <h1 class="sm:text-5xl text-4xl font-bold mb-2">
                    {{ __('cart.order_title') }}
                </h1>

                <p class="text-stone-500 sm:text-lg max-w-2xl">
                    {{ __('cart.order_description') }}
                </p>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div id="cart-items" class="lg:col-span-2 sm:space-y-6 space-y-4">

                    @include('cart.items')
                    
                </div>

                <div>

                    @include('cart.summary', [
                        'showControls' => true,
                        'buttonText' => 'Proceed to Checkout',
                        'buttonRoute' => route('checkout.show'),    
                    ])

                </div>

            </div>
        </div>

    </section>

@endsection