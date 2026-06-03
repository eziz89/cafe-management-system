@extends('layouts.app')

@section('content')

<div class="bg-gray-100">
    <div class="max-w-4xl mx-auto py-20">

        <h1 class="text-4xl font-bold mb-6">
            {{ __('myorder.my_orders') }}
        </h1>

        @forelse($orders as $order)

            <div class="bg-white p-6 rounded-2xl shadow mb-6">

                <div class="flex justify-between items-center">

                    <div>
                        <h2 class="text-xl font-semibold">
                            {{ __('myorder.order') }} #{{ $order->id }}
                        </h2>

                        <p class="text-gray-500 text-sm">
                            {{ $order->created_at->format('d M Y H:i') }}
                        </p>
                    </div>

                    <div>
                        @if($order->status === 'pending')
                            <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
                                Pending
                            </span>

                        @elseif($order->status === 'preparing')
                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                Preparing
                            </span>

                        @elseif($order->status === 'completed')
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                Completed
                            </span>

                        @elseif($order->status === 'cancelled')
                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                Cancelled
                            </span>
                        @endif
                    </div>

                </div>

                
                <div class="flex justify-between items-center">
                    <div class="mt-4">
                        <span>{{ __('myorder.total') }}: </span>
                        <span class="font-bold">
                            {{ number_format($order->total_price, 2) }}
                        </span>
                    </div>

                    <a href="{{ route('orders.show', $order->id) }}" class="text-orange-500 hover:underline">
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

    </div>
</div>

@endsection