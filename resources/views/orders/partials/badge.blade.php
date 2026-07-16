@if($order->status === 'pending')
    <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
        {{ __('status.pending') }}
    </span>

@elseif($order->status === 'preparing')
    <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
        {{ __('status.preparing') }}
    </span>

@elseif($order->status === 'completed')
    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
        {{ __('status.completed') }}
    </span>

@elseif($order->status === 'cancelled')
    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
        {{ __('status.cancelled') }}
    </span>
    
@endif