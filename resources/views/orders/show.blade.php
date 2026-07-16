@extends('layouts.app')

@section('content')

<div class="bg-gray-100">
    <div class="max-w-5xl mx-auto pt-16 pb-24 px-6">

        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">
            <div class="flex justify-between items-center">

                <div>
                    <h1 class="text-4xl font-bold text-stone-800">
                        {{ __('myorder.order') }} #{{ $order->id }}
                    </h1>
                    <p class="text-gray-500">
                        {{ $order->created_at->format('d M Y H:i') }}
                    </p>
                </div>

                <div id="order-status-badge">
                    @include('orders.partials.badge')
                </div>

            </div>
        </div>

        <div class="bg-white rounded-3xl shadow-lg p-8 mb-8">

            <h2 class="text-xl font-bold mb-8">
                Order Status
            </h2>

            <div id="order-timeline" data-order-id="{{ $order->id }}">
                @include('orders.partials.timeline')  
            </div>

        </div>

        <div class="bg-white rounded-2xl shadow p-6">

            <div class="flex justify-between items-center pb-2">
                <h2 class="text-xl font-bold">
                    {{ __('myorder.order_items') }}
                </h2>

                @if($order->status == 'pending')

                    <form action="{{ route('orders.reorder', $order->id) }}" method="POST">
                        @csrf

                        <button type="submit" class="mt-4 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl transition0">
                            {{ __('myorder.reorder') }}
                        </button>
                    </form>
                    
                @endif
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
                                ${{ number_format($item->price,2) }}
                            </p>

                        </div>

                    </div>
            
                    <div class="font-semibold text-lg">
                        ${{ number_format($item->price * $item->quantity, 2) }}
                    </div>
            
                </div>

            @endforeach

            <div class="flex justify-between mt-6 text-lg font-bold">
                <span>{{ __('myorder.total') }}:</span>
                <span class="text-orange-500 text-semibold text-xl">
                    ${{ number_format($order->total_price, 2) }}
                </span>
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-lg p-8 mt-8">

            <h2 class="text-xl font-bold mb-6">
                Order Information
            </h2>
            
            <div class="space-y-5">

                <div>
                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Order Type
                    </p>

                    <p class="font-semibold text-lg mt-2">
                        {{ ucfirst($order->order_type) }}
                    </p>
                </div>
                
                <div>
                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Phone
                    </p>

                    <p class="font-semibold text-lg mt-2">
                        {{ $order->customer_phone }}
                    </p>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Payment
                    </p>

                    <p class="font-semibold text-lg mt-2">
                        {{ ucfirst($order->payment_method) }}
                    </p>
                </div>
            
                @if($order->order_type === 'delivery')
                
                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Delivery Address
                        </p>
        
                        <p class="font-semibold text-lg mt-2">
                            📍 {{ $order->customer_address }}
                        </p>
                    </div>
                
                @endif

                
                @if($order->notes)

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Notes
                        </p>

                        <p class="font-semibold text-lg mt-2"   >
                            {{ $order->notes }}
                        </p>
                    </div>

                @endif

            </div>
            
        </div>

    </div>
</div>

@endsection