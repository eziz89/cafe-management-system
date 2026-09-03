
@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 py-8">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">

        <div class="bg-white rounded-3xl shadow-sm p-8 sm:mb-6 mb-4">

            <h1 class="flex items-center gap-2 sm:text-4xl text-3xl font-bold text-gray-900 mb-2">
                {{ __('account.welcome') }}, {{ $user->name }} <i data-lucide="hand" class="w-12 h-12 wave-effect text-orange-500"></i>
            </h1>

            <p class="text-gray-500">
                {{ __('account.welcome_dashboard') }}
            </p>

        </div>

        <div class="bg-white rounded-3xl shadow-sm p-8 sm:mb-8 mb-6">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">

                <div class="flex items-center gap-5">

                    <div class="w-20 h-20 rounded-full bg-orange-100 flex items-center justify-center text-3xl font-bold text-orange-500">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-neutral-800">
                            {{ $user->name }}
                        </h2>

                        <p class="text-gray-500">
                            {{ $user->email }}
                        </p>

                        <p class="text-sm text-gray-400 mt-1">
                            {{ __('account.joined') }} {{ $user->created_at->format('F Y') }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 sm:gap-6 gap-4 sm:mb-8 mb-6">
            
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

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:mb-8 mb-6">

            <a href="{{ route('menu.index') }}"
               class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">

                <div class="text-3xl mb-3">
                    <i data-lucide="utensils" class="w-8 h-8 text-orange-500"></i>
                </div>

                <h3 class="font-semibold text-gray-800">
                    {{ __('navigation.menu') }}
                </h3>

            </a>


            <a href="{{ route('orders.my') }}"
               class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">

                <div class="text-3xl mb-3">
                    <i data-lucide="shopping-cart" class="w-8 h-8 text-orange-500"></i>
                </div>

                <h3 class="font-semibold text-gray-800">
                    {{ __('navigation.orders') }}
                </h3>

            </a>


            <a href="{{ route('reservations.my') }}"
               class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">

                <div class="text-3xl mb-3">
                    <i data-lucide="calendar" class="w-8 h-8 text-orange-500"></i>
                </div>

                <h3 class="font-semibold text-gray-800">
                    {{ __('navigation.reservations') }}
                </h3>

            </a>


            <a href="{{ route('favorites.index') }}"
               class="bg-white rounded-3xl p-5 shadow-sm hover:shadow-lg hover:-translate-y-1 transition">

                <div class="text-3xl mb-3">
                    <i data-lucide="heart" class="w-8 h-8 text-orange-500"></i>
                </div>

                <h3 class="font-semibold text-gray-800">
                    {{ __('navigation.favorites') }}
                </h3>

            </a>

        </div>

        <div class="bg-white rounded-3xl shadow-sm p-8 mb-8">

            <a href="/my-orders">
                <h2 class="text-2xl font-bold hover:text-orange-500 duration-200 mb-2">
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
                <h2 class="text-2xl font-bold hover:text-orange-500 duration-200 mb-2">
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

            <h2 class="text-2xl font-bold hover:text-orange-500 duration-200 mb-2">
                {{ __('account.recent_reviews') }}
            </h2>

            @forelse($comments as $comment)

                <div class="border-b py-4">
            
                    <div class="flex justify-between items-center mb-2">
            
                        <div class="flex text-orange-500">
                            @for($i = 1; $i <= 5; $i++)
            
                                @if($i <= $comment->rating)
                                    ⭐
                                @else
                                    ☆
                                @endif
            
                            @endfor
                        </div>
            
                        <p class="text-sm text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
            
                    </div>
            
                    <p class="text-gray-700">
                        {{ $comment->comment }}
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