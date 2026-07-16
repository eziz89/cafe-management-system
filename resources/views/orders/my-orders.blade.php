@extends('layouts.app')

@section('content')

<div class="bg-gray-100">
    <div class="max-w-4xl mx-auto py-20">

        <h1 class="text-4xl font-bold mb-6">
            {{ __('myorder.my_orders') }}
        </h1>

        @forelse($orders as $order)

            <div class="bg-white rounded-3xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden mb-8">

                <div class="flex justify-between items-start border-b border-stone-200 p-6">

                    <div>
                        <h2 class="text-3xl font-bold text-stone-800">
                            {{ __('myorder.order') }} #{{ $order->id }}
                        </h2>

                        <p class="text-stone-500 mt-2">
                            {{ $order->created_at->format('d M Y') }}
                        </p>

                        <p class="text-stone-400 text-sm">
                            {{ $order->created_at->format('H:i') }}
                        </p>
                    </div>

                    <div id="order-badge-{{ $order->id }}">
                        @include('orders.partials.badge', ['order' => $order])
                    </div>

                </div>

                <div class="p-6 grid md:grid-cols-2 gap-8">

                    <div class="space-y-5">

                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Order Type
                            </p>

                            <p class="font-semibold mt-2">

                                @if($order->order_type=='delivery')
                                    Delivery
                                @elseif($order->order_type=='takeaway')
                                    Take Away
                                @else
                                    Eat In
                                @endif

                            </p>

                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Payment
                            </p>

                            <p class="font-semibold mt-2">

                                @if($order->payment_method=='cash')
                                    Cash
                                @else
                                    Card
                                @endif

                            </p>
                        </div>

                    </div>

                    <div class="space-y-5">

                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Dishes
                            </p>

                            <p class="font-semibold mt-2">
                                {{ $order->orderItems->count() }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Total
                            </p>

                            <p class="text-3xl font-bold text-orange-500 mt-2">

                                ${{ number_format($order->total_price,2) }}

                            </p>
                        </div>

                    </div>

                    @if($order->order_type == 'delivery')

                        <div>

                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Delivery Address
                            </p>

                            <p class="font-medium mt-2 text-stone-700">

                                📍 {{ Str::limit($order->customer_address, 60) }}

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

    <div class="mt-10">
        {{ $orders->links() }}
    </div>
    
    </div>

</div>

@endsection