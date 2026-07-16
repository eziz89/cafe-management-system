<div class="flex justify-between items-center">

    <div class="text-center">

        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto
            @if($order->status == 'pending' || 
                $order->status == 'preparing' || 
                $order->status == 'completed')
                bg-green-100 text-green-600
            @else
                bg-gray-100 text-gray-400
            @endif">

            ✓

        </div>

        <p class="mt-2 font-semibold">
            Placed
        </p>

    </div>

    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>

    <div class="text-center">

        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto
            @if($order->status == 'preparing')
                bg-yellow-100 text-orange-600
            @elseif($order->status == 'completed')
                bg-green-100 text-green-600
            @else
                bg-gray-100 text-gray-400
            @endif">

            🍳

        </div>

        <p class="mt-2 font-semibold">

            @if($order->status == 'cancelled')
                Cancelled
            @else
                Preparing
            @endif

        </p>

    </div>

    <div class="flex-1 h-1 bg-gray-200 mx-4"></div>

    <div class="text-center">

        <div class="w-12 h-12 rounded-full flex items-center justify-center mx-auto
            @if($order->status == 'completed')
                bg-green-100 text-green-600
            @else
                bg-gray-100 text-gray-400
            @endif">

            ✓

        </div>

        <p class="mt-2 font-semibold">

            @if($order->status == 'cancelled')
                Cancelled
            @else
                Completed
            @endif

        </p>

    </div>

</div>