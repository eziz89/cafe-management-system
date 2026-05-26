@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-10 px-4">

    <div class="max-w-7xl mx-auto">

        {{-- Welcome --}}
        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                Welcome back, {{ $user->name }} 👋
            </h1>

            <p class="text-gray-500">
                Manage your orders, reservations and reviews.
            </p>

        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <p class="text-gray-500 mb-2">
                    Orders
                </p>

                <h2 class="text-4xl font-bold text-orange-500">
                    {{ $user->orders->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <p class="text-gray-500 mb-2">
                    Reservations
                </p>

                <h2 class="text-4xl font-bold text-orange-500">
                    {{ $user->reservations->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <p class="text-gray-500 mb-2">
                    Reviews
                </p>

                <h2 class="text-4xl font-bold text-orange-500">
                    {{ $user->comments->count() }}
                </h2>

            </div>

        </div>

        {{-- Recent Orders --}}
        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <h2 class="text-2xl font-bold mb-6">
                Recent Orders
            </h2>

            @forelse($orders as $order)

                <div class="border-b py-4 flex justify-between">

                    <div>

                        <p class="font-semibold">
                            Order #{{ $order->id }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $order->created_at->diffForHumans() }}
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-full
                                 bg-yellow-100 text-yellow-700 text-sm">

                        {{ ucfirst($order->status) }}

                    </span>

                </div>

            @empty

                <p class="text-gray-500">
                    No orders yet.
                </p>

            @endforelse

        </div>

        {{-- Reservations --}}
        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <h2 class="text-2xl font-bold mb-6">
                Reservations
            </h2>

            @forelse($reservations as $reservation)

                <div class="border-b py-4 flex justify-between">

                    <div>

                        <p class="font-semibold">
                            {{ $reservation->guests }} Guests
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $reservation->reservation_time }}
                        </p>

                    </div>

                    <span class="px-4 py-2 rounded-full
                                 bg-blue-100 text-blue-700 text-sm">

                        {{ ucfirst($reservation->status) }}

                    </span>

                </div>

            @empty

                <p class="text-gray-500">
                    No reservations yet.
                </p>

            @endforelse

        </div>

        {{-- Reviews --}}
        <div class="bg-white rounded-3xl shadow-sm p-8">

            <h2 class="text-2xl font-bold mb-6">
                Recent Reviews
            </h2>

            @forelse($comments as $comment)

                <div class="border-b py-4">

                    <p class="text-gray-700 mb-2">
                        {{ $comment->comment }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $comment->created_at->diffForHumans() }}
                    </p>

                </div>

            @empty

                <p class="text-gray-500">
                    No reviews yet.
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection