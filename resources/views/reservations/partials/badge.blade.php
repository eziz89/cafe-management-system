@if($reservation->status === 'pending')

    <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
        Pending
    </span>

@elseif($reservation->status === 'confirmed')

    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
        Confirmed
    </span>

@elseif($reservation->status === 'completed')

    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
        Completed
    </span>

@elseif($reservation->status === 'cancelled')

    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
        Cancelled
    </span>

@endif