@extends('layouts.app')

@section('content')

<div class="bg-gray-100">

    <div class="max-w-5xl mx-auto sm:pt-16 pt-10 sm:pb-16 pb-12 px-6">

        <div class="bg-white rounded-3xl shadow-lg sm:p-8 p-6 sm:mb-8 mb-6">
            <div class="flex justify-between items-center">

                <div>
                    <h1 class="sm:text-4xl text-3xl font-bold text-stone-800">
                        <div class="flex items-center gap-1">
                            <i data-lucide="receipt-text" class="w-7 h-7 mt-1"></i>
                            {{ __('myorder.order') }} #{{ $order->id }}
                        </div>
                    </h1>

                    <p class="text-gray-500">
                        <div class="flex items-center gap-1 mt-2">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            {{ $order->created_at->format('d M Y H:i') }}
                        </div>
                    </p>
                </div>

                <div id="order-status-badge">
                    @include('orders.partials.badge')
                </div>

            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-lg sm:p-8 sm:mb-8 p-6 mb-6">

            <h2 class="text-xl font-bold sm:mb-8 mb-6">
                Order Status
            </h2>

            <div id="order-timeline" data-order-id="{{ $order->id }}">
                @include('orders.partials.timeline')  
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow p-6">

            <div class="flex justify-between items-center sm:pb-2 pb-0">
                <div class="flex items-center gap-2">
                    <i data-lucide="utensils-crossed" class="w-5 h-5"></i>

                    <h2 class="text-xl font-bold">
                        {{ __('myorder.order_items') }}
                    </h2>
                </div>
            </div>

            @foreach($order->orderItems as $item)

                <div class="flex justify-between items-center border-b border-gray-300 py-5">

                    <div class="flex items-center gap-4">

                        <img
                            src="{{ asset('storage/' . $item->dish->image) }}"
                            alt="{{ $item->dish->name }}"
                            class="w-20 h-20 rounded-2xl object-cover">

                        <div>

                            <h3 class="font-semibold text-lg mb-2">
                                {{ $item->dish->name }}
                            </h3>

                            <p class="text-stone-500 text-sm">
                                {{ $item->quantity }} ×
                                {{ number_format($item->price,2) }} TMT
                            </p>

                        </div>

                    </div>
            
                    <div class="font-semibold text-lg">
                        {{ number_format($item->price * $item->quantity, 2) }} TMT
                    </div>
            
                </div>

            @endforeach

            <div class="flex justify-between mt-6 text-lg font-bold">
                <div class="flex items-center gap-1">
                    <i data-lucide="receipt" class="w-5 h-5"></i>
                    <span>{{ __('myorder.total') }}:</span>
                </div>
                <span class="text-orange-500 text-semibold text-xl">
                    {{ number_format($order->total_price, 2) }} TMT
                </span>
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-8 sm:mt-8 mt-6">

            <h2 class="text-xl font-bold mb-6">
                Order Information
            </h2>
            
            <div class="grid md:grid-cols-2 sm:gap-6 gap-0 space-y-5">

                <div>
                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Order Type
                    </p>

                    <p class="font-semibold text-lg mt-2">

                        @if($order->order_type=='delivery')

                            <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                                <i data-lucide="truck" class="w-5 h-5"></i>
                                Delivery
                            </div>

                        @elseif($order->order_type=='takeaway')

                            <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                                <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                                Take Away
                            </div>

                        @else

                            <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                                <i data-lucide="utensils" class="w-5 h-5"></i>
                                Eat In
                            </div>

                        @endif

                    </p>
                </div>
                
                <div>
                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Phone
                    </p>

                    <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                        <i data-lucide="phone" class="w-5 h-5"></i>
                        {{ $order->customer_phone }}
                    </div>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Payment
                    </p>

                    @if($order->payment_method=='cash')

                        <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                            <i data-lucide="banknote" class="w-5 h-5"></i>
                            Cash
                        </div>

                        @else

                        <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                            <i data-lucide="credit-card" class="w-5 h-5"></i>
                            Card
                        </div>

                    @endif
                    
                </div>
            
                @if($order->order_type === 'delivery')
                
                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Delivery Address
                        </p>

                        <div class="flex items-center gap-1 font-semibold text-lg mt-2">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                            {{ $order->customer_address }}
                        </div>
                    </div>
                
                @endif

                
                @if($order->notes)

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Notes
                        </p>

                        <p class="font-semibold text-lg mt-2">
                            {{ $order->notes }}
                        </p>
                    </div>

                @endif

            </div>
            
        </div>

    </div>
</div>

@endsection