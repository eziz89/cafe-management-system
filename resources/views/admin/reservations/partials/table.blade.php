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

            @forelse($reservations as $reservation)

                <tr class="border-t border-gray-200"
                    id="reservation-{{ $reservation->id }}">

                    <td class="px-6 py-4">
                        {{ $reservation->name }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $reservation->phone }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $reservation->guests }}
                    </td>


                    <td class="px-6 py-4">
                        {{ $reservation->reservation_time }}
                    </td>


                    <td class="px-6 py-4">

                        <span id="reservation-status-{{ $reservation->id }}"
                            class="
                            px-4 py-2 rounded-full text-sm font-semibold

                            @if($reservation->status === 'pending')
                                bg-gray-200 text-gray-700

                            @elseif($reservation->status === 'confirmed')
                                bg-green-100 text-green-700

                            @else
                                bg-red-100 text-red-700

                            @endif
                            ">

                            {{ ucfirst($reservation->status) }}

                        </span>

                    </td>


                    <td class="px-6 py-4">

                        <div id="reservation-actions-{{ $reservation->id }}">

                            @include(
                                'admin.reservations.partials.actions',
                                [
                                    'reservation' => $reservation
                                ]
                            )

                        </div>

                    </td>

                </tr>


            @empty

                <tr>

                    <td colspan="6"
                        class="py-16 text-center">

                        <div class="text-5xl mb-4">
                            📅
                        </div>

                        <h3 class="text-xl font-bold">
                            No reservations found
                        </h3>

                    </td>

                </tr>

            @endforelse


        </tbody>

    </table>


</div>

<div class="pagination mt-6 mx-6">

    {{ $reservations->links() }}

</div>