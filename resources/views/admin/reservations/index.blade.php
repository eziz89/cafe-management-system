@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto">
        <h1 class="text-5xl font-bold mb-10">
            Reservations
        </h1>

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <table class="w-full">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Phone</th>
                        <th class="px-6 py-4 text-left">Guests</th>
                        <th class="px-6 py-4 text-left">Reservation Time</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="border-t">   
                            <td class="px-6 py-4">{{ $reservation->name }}</td>
                            <td class="px-6 py-4">{{ $reservation->phone }}</td>
                            <td class="px-6 py-4">{{ $reservation->guests }}</td>
                            <td class="px-6 py-4">{{ $reservation->reservation_time }}</td>
                            <td class="px-6 py-4">
                                @if($reservation->status === 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                        Pending
                                    </span>
                                @elseif($reservation->status === 'confirmed')
                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                        Confirmed
                                    </span>
                                @elseif($reservation->status === 'cancelled')
                                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="flex gap-3">
                                    <form action="/admin/reservations/{{ $reservation->id }}/status" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="confirmed">
                                        <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1.5 rounded-md">
                                            Confirm
                                        </button>
                                    </form>

                                    <form action="/admin/reservations/{{ $reservation->id }}/status" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <input type="hidden" name="status" value="cancelled">
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-md">
                                            Cancel
                                        </button>
                                    </form>
                                </div>
                            </td> 
                        </tr>
                              
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

@endsection