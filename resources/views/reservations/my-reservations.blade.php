@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-6 py-10">

    <h1 class="text-4xl font-bold mb-8">
        My Reservations
    </h1>

    @forelse($reservations as $reservation)

        <div class="bg-white rounded-2xl shadow-md p-6 mb-6">

            <div class="flex justify-between items-center">

                <div>
                    <h2 class="text-xl font-semibold">
                        Reservation for {{ $reservation->guests }} guests
                    </h2>

                    <p class="text-gray-500 mt-1">
                        {{ $reservation->reservation_time }}
                    </p>
                </div>

                <div>

                    @if($reservation->status === 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm">
                            Pending
                        </span>

                    @elseif($reservation->status === 'confirmed')
                        <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm">
                            Confirmed
                        </span>

                    @elseif($reservation->status === 'cancelled')
                        <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm">
                            Cancelled
                        </span>
                    @endif

                </div>

            </div>

        </div>

    @empty

        <div class="bg-white rounded-2xl shadow-md p-8 text-center">

            <h2 class="text-2xl font-bold mb-3">
                No reservations yet
            </h2>

            <p class="text-gray-500 mb-6">
                You have not made any reservations.
            </p>

            <a href="{{ route('reservations.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl transition">

                Reserve a Table

            </a>

        </div>

    @endforelse

</div>

@endsection