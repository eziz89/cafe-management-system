@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-6">

    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <div class="flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-bold">
                    Order #{{ $order->id }}
                </h1>
                <p class="text-gray-500">
                    {{ $order->created_at->format('d M Y H:i') }}
                </p>
            </div>

            <div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold mb-4">
            Order Items
        </h2>

        @foreach($order->orderItems as $item)

            <div class="flex justify-between items-center border-b py-3">
                <div>
                    <h3 class="font-semibold">
                        {{ $item->dish->name }}
                    </h3>
                    <p class="text-gray-500 text-sm">
                        {{ $item->quantity }} × ${{ $item->price }}
                    </p>
                </div>

                <div class="font-bold">
                    ${{ number_format($item->price * $item->quantity, 2) }}
                </div>
            </div>

            <form action="{{ route('orders.reorder', $order->id) }}" method="POST">
                @csrf

                <button type="submit" class="mt-4 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl transition0">
                    Reorder
                </button>
            </form>

        @endforeach

        <div class="flex justify-between mt-6 text-lg font-bold">
            <span>Total:</span>
            <span>
                ${{ number_format($order->total_price, 2) }}
            </span>
        </div>
        
    </div>

</div>

@endsection