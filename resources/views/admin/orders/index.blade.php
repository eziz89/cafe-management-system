@extends('layouts.admin')

@section('content')

    <section class="min-h-screen bg-stone-100">

        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-4">
                    Administration
                </p>
                <h1 class="text-5xl font-bold text-stone-800">
                    Orders
                </h1>
            </div>
    
            <div class="space-y-8 mb-12">

                @foreach($orders as $order)

                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h2 class="text-2xl font-bold text-stone-800">
                                    Order #{{ $order->id }}
                                </h2>
                                <p class="text-stone-500">
                                    {{ $order->created_at->format('d M Y H:i') }}
                                </p>
                            </div>

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

                        <div class="grid md:grid-cols-2 gap-10">
                            <div>
                                <h3 class="font-bold text-lg mb-4">
                                    Customer
                                </h3>
                                <p>{{ $order->user->name ?? 'Guest' }}</p>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-4">
                                    Order Details
                                </h3>
                                <p>Total: ${{ $order->total_price ?? '0.00' }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="font-bold text-lg mb-4">
                                Ordered Dishes
                            </h3>

                            <div class="space-y-3">
                                @foreach($order->orderItems as $item)

                                    <div class="flex justify-between items-center bg-stone-100 rounded-2xl px-4 py-3">
                                        <div>
                                            <p class="font-semibold">
                                                {{ $item->dish->name }}
                                            </p>
                                            <p class="text-stone-500 text-sm">
                                                Quantity: {{ $item->quantity }}
                                            </p>
                                        </div>
                                        <p class="font-bold text-orange-500 text-end">
                                            ${{ $item->price }}
                                        </p>
                                    
                                        <div class="grid md:grid-cols-3 lg:grid-cols-3 space-x-2">
                                            <form action="/admin/orders/{{ $order->id }}/status" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" name="status" value="preparing">
                                                <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-md text-sm">
                                                    Preparing
                                                </button>
                                            </form>

                                            <form action="/admin/orders/{{ $order->id }}/status" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" name="status" value="completed">
                                                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm">
                                                    Complete
                                                </button>
                                            </form>

                                            <form action="/admin/orders/{{ $order->id }}/status" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" name="status" value="cancelled">
                                                <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md text-sm">
                                                    Cancel
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        
                    </div>

                @endforeach

            </div>
        </div>
    
    </section>

@endsection