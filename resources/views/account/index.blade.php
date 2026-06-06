@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-10 pb-24">

    <div class="max-w-7xl mx-auto">

        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <h1 class="text-4xl font-bold text-gray-900 mb-2">
                {{ __('account.welcome') }}, {{ $user->name }} 👋
            </h1>

            <p class="text-gray-500">
                {{ __('account.welcome_dashboard') }}
            </p>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <p class="text-gray-500 mb-2">
                    {{ __('account.orders') }}
                </p>

                <h2 class="text-4xl font-bold text-orange-500">
                    {{ $user->orders->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <p class="text-gray-500 mb-2">
                    {{ __('account.reservations') }}
                </p>

                <h2 class="text-4xl font-bold text-orange-500">
                    {{ $user->reservations->count() }}
                </h2>

            </div>

            <div class="bg-white rounded-3xl p-6 shadow-sm">

                <p class="text-gray-500 mb-2">
                    {{ __('account.reviews') }}
                </p>

                <h2 class="text-4xl font-bold text-orange-500">
                    {{ $user->comments->count() }}
                </h2>

            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <a href="/my-orders">
                <h2 class="text-2xl font-bold hover:text-orange-500 duration-200 mb-6">
                    {{ __('account.recent_orders') }}
                </h2>
            </a>

            @forelse($orders as $order)

                <div class="border-b py-4 flex justify-between">

                    <a href="{{ route('orders.show', $order->id) }}">

                        <p class="font-semibold">
                            {{ __('account.order') }} #{{ $order->id }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $order->created_at->diffForHumans() }}
                        </p>

                    </a>

                    <div>
                        @if($order->status === 'pending')
                            <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
                                {{ __('status.pending') }}
                            </span>

                        @elseif($order->status === 'preparing')
                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                {{ __('status.preparing') }}
                            </span>

                        @elseif($order->status === 'completed')
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                {{ __('status.completed') }}
                            </span>

                        @elseif($order->status === 'cancelled')
                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                {{ __('status.cancelled') }}
                            </span>

                        @endif
                    </div>

                </div>

            @empty

                <p class="text-gray-500">
                    {{ __('account.no_orders') }}
                </p>

            @endforelse

        </div>

        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <a href="/my-reservations">
                <h2 class="text-2xl font-bold hover:text-orange-500 duration-200 mb-6">
                    {{ __('account.reservations') }}
                </h2>
            </a>

            @forelse($reservations as $reservation)

                <div class="border-b py-4 flex justify-between">

                    <div>

                        <p class="font-semibold">
                            {{ $reservation->guests }} {{ __('account.guests') }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $reservation->reservation_time }}
                        </p>

                    </div>

                    <div>

                        @if($reservation->status === 'pending')
                            <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
                                {{ __('status.pending') }}
                            </span>

                        @elseif($reservation->status === 'confirmed')
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                                {{ __('status.confirmed') }}
                            </span>

                        @elseif($reservation->status === 'cancelled')
                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">
                                {{ __('status.cancelled') }}
                            </span>
                        @endif

                    </div>
                </div>

            @empty

                <p class="text-gray-500">
                    {{ __('account.no_reservations') }}
                </p>

            @endforelse

        </div>

        <div class="bg-white rounded-3xl shadow-sm p-8">

            <h2 class="text-2xl font-bold hover:text-orange-500 duration-200 mb-6">
                {{ __('account.recent_reviews') }}
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
                    {{ __('account.no_reviews') }}
                </p>

            @endforelse

        </div>

    </div>

</div>

@endsection