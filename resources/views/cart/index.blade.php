@extends('layouts.app')

@section('content')

    <section class="bg-stone-100 min-h-screen py-12">

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