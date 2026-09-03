<div class="space-y-3 sm:space-y-4">

    @if($order->status === 'pending')

        {{-- Start Preparing --}}
        <form
            class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status', $order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="preparing">

            <button
                type="submit"
                class="w-full sm:py-3 py-2 sm:py-4 px-4 rounded-2xl
                    bg-orange-500 hover:bg-orange-600
                    text-white font-semibold
                    transition duration-300
                    flex items-center justify-center gap-2
                    hover:shadow-lg hover:shadow-orange-500/30">

                <i data-lucide="play" class="w-4 h-4 sm:w-5 sm:h-5"></i>

                <span>Taýýarlap başlamak</span>

            </button>

        </form>

        {{-- Cancel Order --}}
        <form
            class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status', $order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="cancelled">

            <button
                type="submit"
                class="w-full sm:py-3 py-2 sm:py-4 px-4 rounded-2xl
                    bg-red-500 hover:bg-red-600
                    text-white font-semibold
                    transition duration-300
                    flex items-center justify-center gap-2
                    hover:shadow-lg hover:shadow-red-500/30">

                <i data-lucide="x" class="w-4 h-4 sm:w-5 sm:h-5"></i>

                <span>Sargydy Ýatyrmak</span>

            </button>

        </form>

    @elseif($order->status === 'preparing')

        {{-- Complete Order --}}
        <form
            class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status', $order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="completed">

            <button
                type="submit"
                class="w-full sm:py-3 py-2 sm:py-4 px-4 rounded-2xl
                    bg-green-500 hover:bg-green-600
                    text-white font-semibold
                    transition duration-300
                    flex items-center justify-center gap-2
                    hover:shadow-lg hover:shadow-green-500/30">

                <i data-lucide="check" class="w-4 h-4 sm:w-5 sm:h-5"></i>

                <span>Sargydy Tamamlamak</span>

            </button>

        </form>

        {{-- Cancel Order --}}
        <form
            class="order-status-form"
            data-order-id="{{ $order->id }}"
            action="{{ route('admin.orders.status', $order) }}"
            method="POST">

            @csrf
            @method('PATCH')

            <input type="hidden" name="status" value="cancelled">

            <button
                type="submit"
                class="w-full sm:py-3 py-2 sm:py-4 px-4 rounded-2xl
                    bg-red-500 hover:bg-red-600
                    text-white font-semibold
                    transition duration-300
                    flex items-center justify-center gap-2
                    hover:shadow-lg hover:shadow-red-500/30">

                <i data-lucide="x" class="w-4 h-4 sm:w-5 sm:h-5"></i>

                <span>Sargydy Ýatyrmak</span>

            </button>

        </form>

    @elseif($order->status === 'completed')

        <div class="rounded-2xl bg-green-50 border border-green-200 p-5 sm:p-8 text-center">

            <div class="flex justify-center mb-2">

                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">

                    <i data-lucide="check" class="w-5 h-5 text-green-600">
                    </i>

                </div>

            </div>

            <p class="font-semibold text-green-700">
                Sargyt Tamamlandy
            </p>

        </div>

    @else

        <div class="rounded-2xl bg-red-50 border border-red-200 p-5 sm:p-8 text-center">

            <div class="flex justify-center mb-2">

                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">

                    <i data-lucide="x" class="w-5 h-5 text-red-600">
                    </i>

                </div>

            </div>

            <p class="font-semibold text-red-700">
                Sargyt Ýatyryldy
            </p>

        </div>

    @endif

</div>