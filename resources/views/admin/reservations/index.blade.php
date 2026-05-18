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
                        <th class="p-4 text-left">Name</th>
                        <th class="p-4 text-left">Phone</th>
                        <th class="p-4 text-left">Guests</th>
                        <th class="p-4 text-left">Reservation Time</th>
                        <th class="p-4 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($reservations as $reservaion)
                        <tr class="border-t">
                            <td class="p-4">{{ $reservaion->name }}</td>
                            <td class="p-4">{{ $reservaion->phone }}</td>
                            <td class="p-4">{{ $reservaion->guests }}</td>
                            <td class="p-4">{{ $reservaion->reservation_time }}</td>
                            <td class="p-4">
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    {{ $reservaion->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection