@if($order->status === 'pending')
    <div class="flex items-center gap-1 bg-gray-200 text-gray-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="clock-3" class="w-5 h-5"></i>
        {{ __('status.pending') }}
    </div>

@elseif($order->status === 'preparing')
    <div class="flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="chef-hat" class="w-5 h-5"></i>
        {{ __('status.preparing') }}
    </div>

@elseif($order->status === 'completed')
    <div class="flex items-center gap-1 bg-green-100 text-green-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="circle-check" class="w-5 h-5"></i>
        {{ __('status.completed') }}
    </div>

@elseif($order->status === 'cancelled')
    <div class="flex items-center gap-1 bg-red-100 text-red-700 px-3 py-2 rounded-full text-sm font-semibold">
        <i data-lucide="circle-x" class="w-5 h-5"></i>
        {{ __('status.cancelled') }}
    </div>
    
@endif