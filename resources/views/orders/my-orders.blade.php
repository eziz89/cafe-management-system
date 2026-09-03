@extends('layouts.app')

@section('content')

<div class="bg-gray-100">

    <div class="max-w-4xl mx-auto sm:py-12 py-8 pt-12 sm:px-0 px-6">

        <h1 class="text-4xl font-bold mb-6">
            {{ __('myorder.my_orders') }}
        </h1>

        @forelse($orders as $order)

            <div class="bg-white rounded-3xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden mb-8">

                <div class="flex justify-between items-start border-b border-stone-200 p-6">

                    <div>
                        <h2 class="text-3xl font-bold text-stone-800">

                            <div class="flex items-center gap-1">
                                <i data-lucide="receipt-text" class="w-7 h-7 mt-1"></i>
                                {{ __('myorder.order') }} #{{ $order->id }}
                            </div>

                        </h2>

                        <div class="flex items-center gap-1 mt-2">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <p class="text-stone-500">
                                {{ $order->created_at->format('d M Y') }}
                            </p>
                        </div>

                        <p class="text-stone-400 text-sm">
                            {{ $order->created_at->format('H:i') }}
                        </p>
                    </div>

                    <div id="order-badge-{{ $order->id }}">
                        @include('orders.partials.badge', ['order' => $order])
                    </div>

                </div>

                <div class="p-6 grid md:grid-cols-2 sm:gap-8 gap-6">

                    <div class="space-y-5">

                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Order Type
                            </p>

                            <p class="font-semibold mt-2">

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
                                Payment
                            </p>

                            <p class="font-semibold mt-2">

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
                    
                            </p>
                        </div>

                    </div>

                    <div class="space-y-5">

                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Dishes
                            </p>

                            <div class="flex items-center gap-2 font-semibold text-lg mt-2">
                                <i data-lucide="layers-2" class="w-5 h-5"></i>
                                {{ $order->orderItems->count() }}
                            </div>
                        </div>

                        <div>

                            <div class="flex items-center gap-1">

                                <p class="text-xs uppercase tracking-widest text-stone-400">
                                    Total
                                </p>

                            </div>

                            <p class="text-3xl font-bold text-orange-500 mt-2">

                                {{ number_format($order->total_price,2) }} TMT

                            </p>
                        </div>

                    </div>

                    @if($order->order_type == 'delivery')

                        <div>

                            <div class="flex items-center gap-1 text-xs uppercase tracking-widest text-stone-400">
                                <i data-lucide="map-pin" class="w-4 h-4"></i>
                                Delivery Address
                            </div>

                            <p class="font-medium mt-2 text-stone-700">

                                {{ Str::limit($order->customer_address, 60) }}

                            </p>

                        </div>
                    @endif

                </div>
                
                <div class="border-t border-stone-200 px-8 py-4 flex justify-end">

                    <a href="{{ route('orders.show',$order) }}" class="font-semibold text-orange-500 hover:text-orange-600 transition">
                        {{ __('myorder.view_details') }}
                    </a>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl shadow-md p-8 text-center">

                <h2 class="text-2xl font-bold mb-3">
                    {{ __('myorder.no_orders') }}
                </h2>

                <p class="text-gray-500 mb-6">
                    {{ __('myorder.no_orders_description') }}
                </p>

                <a href="/menu" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl transition">
                    {{ __('navigation.browse_menu') }}
                </a>
            </div>

        @endforelse

        <div class="sm:mt-10">
            {{ $orders->links() }}
        </div>
    
    </div>

</div>

@endsection