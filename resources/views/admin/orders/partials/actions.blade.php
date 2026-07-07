<div class="space-y-4">

    @if($order->status === 'pending')

        <form class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status',$order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="preparing">

            <button class="w-full py-4 rounded-2xl bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">

                Start Preparing

            </button>

        </form>

        <form class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status',$order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden"
                name="status"
                value="cancelled">

            <button
                class="w-full py-4 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">

                Cancel Order

            </button>

        </form>

    @elseif($order->status === 'preparing')

        <form class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status',$order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden"
                name="status"
                value="completed">

            <button
                class="w-full py-4 rounded-2xl bg-green-500 hover:bg-green-600 text-white font-semibold transition">

                Complete Order

            </button>

        </form>

        <form class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status',$order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden"
                name="status"
                value="cancelled">

            <button
                class="w-full py-4 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">

                Cancel Order

            </button>

        </form>

    @elseif($order->status === 'completed')

        <div
            class="rounded-2xl bg-green-50 p-8 text-center">

            <p class="text-2xl font-bold text-green-600">
                ✓
            </p>

            <p class="font-semibold mt-2">
                Order completed
            </p>

        </div>

    @else

        <div
            class="rounded-2xl bg-red-50 p-8 text-center">

            <p class="text-2xl font-bold text-red-600">
                ✕
            </p>

            <p class="font-semibold mt-2">
                Order cancelled
            </p>

        </div>

    @endif

</div>