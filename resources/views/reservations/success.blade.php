@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen flex items-center justify-center py-20">

    <div class="bg-white rounded-3xl shadow-xl p-10 max-w-xl text-center">

        <div class="text-6xl mb-5">
            🎉
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            Reservation Submitted!
        </h1>


        <p class="text-gray-500 mb-6">
            Your table reservation has been received.
        </p>


        <div class="bg-orange-50 rounded-2xl p-5 text-left mb-6">

            <p>
                <strong>Name:</strong>
                {{ $reservation->name }}
            </p>

            <p>
                <strong>Guests:</strong>
                {{ $reservation->guests }}
            </p>

            <p>
                <strong>Date:</strong>
                {{ $reservation->reservation_time->format('d M Y, H:i') }}
            </p>

        </div>


        @auth

            <p class="text-gray-600 mb-6">
                You can track your reservation status from your account.
            </p>


            <a href="{{ route('reservations.my') }}"
               class="inline-block bg-orange-500 text-white px-6 py-3 rounded-xl">

                My Reservations

            </a>

        @else

            <p class="text-gray-600 mb-6">

                We will contact you when your reservation is confirmed.

                Create an account to track your reservations live.

            </p>

            <a href="{{ route('login') }}"
               class="inline-block bg-orange-500 text-white px-6 py-3 rounded-xl">

                Create Account

            </a>

        @endauth

    </div>

</section>

@endsection