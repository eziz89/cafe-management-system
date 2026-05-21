@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-10">

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
                        <span>Pending</span>

                    @elseif($order->status === 'preparing')
                        <span>Preparing</span>

                    @elseif($order->status === 'completed')
                        <span>Completed</span>

                    @elseif($order->status === 'cancelled')
                        <span>Cancelled</span>
                    @endif
                </div>

            </div>

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

@endsection