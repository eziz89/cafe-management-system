<div class="hidden md:block bg-white shadow-lg rounded-2xl overflow-hidden">

    <table class="w-full">

        <thead class="bg-gray-100">

            <tr>
                <th class="px-6 py-4 text-left">Ady</th>
                <th class="px-6 py-4 text-left">Telefon belgisi</th>
                <th class="px-6 py-4 text-left">Myhmanlar</th>
                <th class="px-6 py-4 text-left">Bronlama wagty</th>
                <th class="px-6 py-4 text-left">Ýagdaý</th>
                <th class="px-6 py-4 text-left">Hereketler</th>
            </tr>

        </thead>


        <tbody>

            @forelse($reservations as $reservation)

                <tr class="border-t border-gray-200" id="reservation-{{ $reservation->id }}">

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
                            class="px-4 py-2 rounded-full text-sm font-semibold
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

                        <i data-lucide="calendar-x"
                            class="w-16 h-16 mx-auto text-stone-400 mb-4">
                        </i>

                        <h3 class="text-xl font-bold">
                            Bron tapylmady
                        </h3>

                    </td>

                </tr>

            @endforelse


        </tbody>

    </table>


</div>

<div class="md:hidden space-y-5">

    @forelse($reservations as $reservation)

        <div 
            id="reservation-mobile-{{ $reservation->id }}"
            class="bg-white rounded-3xl shadow-md p-6 border border-stone-100">

            <div class="flex justify-between items-start mb-5">

                <div>

                    <h2 class="text-xl font-bold text-stone-800">
                        {{ $reservation->name }}
                    </h2>

                    <p class="text-sm text-stone-500 mt-1">
                        Bronlama #{{ $reservation->id }}
                    </p>

                </div>


                <span 
                    id="reservation-status-mobile-{{ $reservation->id }}"
                    class="
                    px-3 py-1 rounded-full text-xs font-semibold

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

            </div>


            <div class="space-y-4 text-stone-600">


                <div class="flex items-center gap-3">

                    <i data-lucide="phone" class="w-5 h-5 text-orange-500"></i>

                    <span>
                        {{ $reservation->phone }}
                    </span>

                </div>


                <div class="flex items-center gap-3">

                    <i data-lucide="users" class="w-5 h-5 text-orange-500"></i>

                    <span>
                        {{ $reservation->guests }} myhman
                    </span>

                </div>


                <div class="flex items-center gap-3">

                    <i data-lucide="calendar-clock" class="w-5 h-5 text-orange-500"></i>

                    <span>
                        {{ $reservation->reservation_time }}
                    </span>

                </div>


            </div>


            <div 
                id="reservation-actions-mobile-{{ $reservation->id }}"
                class="mt-6">

                @include(
                    'admin.reservations.partials.actions',
                    [
                        'reservation' => $reservation
                    ]
                )

            </div>


        </div>


    @empty

        <div class="bg-white rounded-3xl shadow-md p-8 text-center">

            <i data-lucide="calendar-x"
               class="w-16 h-16 mx-auto text-stone-400 mb-4">
            </i>

            <h3 class="text-xl font-bold">
                Bronlama tapylmady
            </h3>

        </div>

    @endforelse

</div>

<div class="mt-6 px-2 sm:px-6">
    {{ $reservations->links() }}
</div>