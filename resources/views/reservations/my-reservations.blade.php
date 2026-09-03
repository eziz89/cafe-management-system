@extends('layouts.app')

@section('content')

<div class="bg-gray-100">
    <div class="max-w-4xl mx-auto sm:py-12 pb-4 pt-12 sm:px-0 px-6">

        <h1 class="text-4xl font-bold mb-8">
            {{ __('myreservation.my_reservations') }}
        </h1>

        @forelse($reservations as $reservation)

            <div class="bg-white rounded-2xl shadow-md p-6 mb-6">

                <div class="flex justify-between items-center">

                    <div class="min-w-0">

                        <h2 class="text-lg sm:text-xl font-semibold">
                            {{ __('myreservation.reservation_for') }} {{ $reservation->guests }} {{ __('myreservation.guests') }}
                        </h2>

                        <div class="flex text-gray-500 items-start gap-1 mt-2 text-sm sm:text-base">
                            <i data-lucide="calendar" class="w-4 h-4 mt-0.5 shrink-0"></i>
                            <span>{{ $reservation->reservation_time }}</span>
                        </div>
                    </div>

                    <div class="shrink-0">

                        <div
                            id="reservation-card-{{ $reservation->id }}"
                            data-id="{{ $reservation->id }}"
                            data-status="{{ $reservation->status }}"
                        >

                            <div id="reservation-badge-{{ $reservation->id }}">
                                @include('reservations.partials.badge', [
                                    'reservation' => $reservation
                                ])
                            </div>

                        </div>
                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-2xl shadow-md p-8 text-center">

                <h2 class="text-2xl font-bold mb-3">
                    {{ __('myreservation.no_reservations') }}
                </h2>

                <p class="text-gray-500 mb-6">
                    {{ __('myreservation.no_reservations_description') }}
                </p>

                <a href="{{ route('reservations.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl transition">
                    {{ __('navigation.reserve') }}
                </a>

            </div>

        @endforelse

    </div>
</div>

@endsection