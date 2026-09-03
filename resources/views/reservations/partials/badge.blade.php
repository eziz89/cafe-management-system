@if($reservation->status === 'pending')

    <div class="flex items-center gap-1 bg-gray-200 text-gray-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="clock-3" class="w-5 h-5"></i>
        Pending
    </div>

@elseif($reservation->status === 'confirmed')

    <div class="flex items-center gap-1 bg-green-100 text-green-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="circle-check" class="w-5 h-5"></i>
        Confirmed
    </div>

@elseif($reservation->status === 'completed')

    <div class="flex items-center gap-1 bg-green-100 text-green-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="circle-check" class="w-5 h-5"></i>
        Completed
    </div>

@elseif($reservation->status === 'cancelled')

    <div class="flex items-center gap-1 bg-red-100 text-red-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="circle-x" class="w-5 h-5"></i>
        Cancelled
    </div>

@endif