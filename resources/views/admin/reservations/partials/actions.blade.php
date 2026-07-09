@if($reservation->status === 'pending')

<div class="flex gap-3">


    <form class="reservation-status-form"
          data-id="{{ $reservation->id }}"
          action="{{ route('admin.reservations.status', $reservation) }}"
          method="POST">

        @csrf
        @method('PATCH')

        <input type="hidden"
               name="status"
               value="confirmed">


        <button
            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">

            Confirm

        </button>


    </form>



    <form class="reservation-status-form"
          data-id="{{ $reservation->id }}"
          action="{{ route('admin.reservations.status', $reservation) }}"
          method="POST">

        @csrf
        @method('PATCH')

        <input type="hidden"
               name="status"
               value="cancelled">


        <button
            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">

            Cancel

        </button>


    </form>


</div>


@elseif($reservation->status === 'confirmed')


<span class="text-green-600 font-semibold">
    ✓ Reservation confirmed
</span>


@else


<span class="text-red-600 font-semibold">
    ✕ Reservation cancelled
</span>


@endif