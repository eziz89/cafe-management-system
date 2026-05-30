@extends('layouts.app')

@section('content')

<div class="bg-gray-100">
    <div class="max-w-4xl mx-auto py-20">

        <h1 class="text-3xl font-bold mb-6">
            My Orders
        </h1>

        @forelse($orders as $order)

            <div class="bg-white p-6 rounded-2xl shadow mb-6">

                <div class="flex justify-between items-center">

                    <div>
                        <h2 class="text-xl font-semibold">
                            Order #{{ $order->id }}
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
                        <span>Total: </span>
                        <span class="font-bold">
                            {{ number_format($order->total_price, 2) }}
                        </span>
                    </div>

                    <a href="{{ route('orders.show', $order->id) }}" class="text-orange-500 hover:underline">
                        View Details
                    </a>
                </div>

            </div>

        @empty

            <div class="text-center py-10">
                <h2 class="text-2xl font-semibold mb-2">
                    No orders yet
                </h2>

                <p class="text-gray-500 mb-4">
                    You haven't placed any orders so far
                </p>

                <a href="/menu" class="text-blue-500 underline">
                    Browse Menu
                </a>
            </div>

        @endforelse

    </div>
</div>

@endsection