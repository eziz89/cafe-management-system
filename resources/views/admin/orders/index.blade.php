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
    
            <div class="space-y-8">

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
                            <span class="bg-orange-100 text-orange-600 px-4 py-2 rounded-xl font-semibold">
                                {{ ucfirst($order->status) }}
                            </span>
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
                                @foreach($order->items as $item)

                                    <div class="flex justify-between bg-stone-100 rounded-2xl px-4 py-3">
                                        <div>
                                            <p class="font-semibold">
                                                {{ $item->dish->name }}
                                            </p>
                                            <p class="text-stone-500 text-sm">
                                                Quantity: {{ $item->quantity }}
                                            </p>
                                        </div>
                                        <p class="font-bold text-orange-500">
                                            ${{ $item->price }}
                                        </p>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="mt-6 flex gap-4">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="rounded-xl border-stone-300">

                                <option value="pending"
                                    {{ $order->status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="preparing"
                                    {{ $order->status == 'preparing' ? 'selected' : '' }}>
                                    Preparing
                                </option>

                                <option value="completed"
                                    {{ $order->status == 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                            </select>

                            <button class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-xl">
                                Update
                            </button>
                        </form>
                    </div>

                @endforeach

            </div>
        </div>
    
    </section>

@endsection