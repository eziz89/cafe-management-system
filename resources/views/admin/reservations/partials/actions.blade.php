@if($reservation->status === 'pending')

<div class="flex flex-col sm:flex-row gap-3">

    <form class="reservation-status-form"
        data-id="{{ $reservation->id }}"
        action="{{ route('admin.reservations.status', $reservation) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <input type="hidden" name="status" value="confirmed">

        <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl">

            Tassyklamak

        </button>

    </form>

    <form class="reservation-status-form"
        data-id="{{ $reservation->id }}"
        action="{{ route('admin.reservations.status', $reservation) }}"
        method="POST">

        @csrf
        @method('PATCH')

        <input type="hidden" name="status" value="cancelled">

        <button class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl">

            Ýatyr

        </button>

    </form>

</div>


@elseif($reservation->status === 'confirmed')

<span class="flex items-center gap-2 text-green-600 font-semibold">

    <i data-lucide="check" class="w-5 h-5"></i>
    Bronlama tassyklandy
    
</span>

@else

<span class="flex items-center gap-2 text-red-600 font-semibold">

    <i data-lucide="x" class="w-5 h-5"></i>
    Bronlama ýatyryldy

</span>

@endif