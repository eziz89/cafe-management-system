<div id="order-{{ $order->id }}"
    class="relative bg-white rounded-3xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden mb-8">

    {{-- Status Accent --}}
    <div
        class="absolute left-0 top-0 h-full w-1.5
        @if($order->status=='pending')
            bg-gray-400
        @elseif($order->status=='preparing')
            bg-orange-500
        @elseif($order->status=='completed')
            bg-green-500
        @else
            bg-red-500
        @endif">
    </div>

    <div class="grid lg:grid-cols-12">

        {{-- ===================================== --}}
        {{-- LEFT COLUMN --}}
        {{-- ===================================== --}}

        <div class="lg:col-span-3 p-8 border-r border-stone-200">

            <div class="flex items-center gap-4">

                <div
                    class="w-16 h-16 rounded-2xl bg-orange-50 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-orange-500"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M3 7h18M6 7V5a2 2 0 012-2h8a2 2 0 012 2v2m-1 0v12a2 2 0 01-2 2H8a2 2 0 01-2-2V7"/>

                    </svg>

                </div>

                <div>

                    <h2 class="text-3xl font-bold text-stone-800">
                        #{{ $order->id }}
                    </h2>

                    <p class="text-stone-500 mt-1">
                        {{ $order->created_at->format('d M Y') }}
                    </p>

                    <p class="text-stone-400 text-sm">
                        {{ $order->created_at->format('H:i') }}
                    </p>

                </div>

            </div>

            <hr class="my-8">

            <div class="space-y-6">

                <div>

                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Customer
                    </p>

                    <p class="font-semibold text-lg mt-2">
                        {{ $order->user->name ?? 'Guest' }}
                    </p>

                </div>

                <div>

                    <p class="text-xs uppercase tracking-widest text-stone-400">
                        Total
                    </p>

                    <p class="text-3xl font-bold text-orange-500 mt-2">
                        ${{ number_format($order->total_price,2) }}
                    </p>

                </div>

            </div>

        </div>

        {{-- ===================================== --}}
        {{-- MIDDLE COLUMN --}}
        {{-- ===================================== --}}

        <div class="lg:col-span-5 p-8">

            <h3 class="font-bold text-xl mb-6">

                Ordered Dishes

                <span class="text-stone-400 text-base">
                    ({{ $order->orderItems->count() }})
                </span>

            </h3>

            <div class="space-y-4 max-h-70 overflow-y-auto scrollbar-thin pr-2">

                @foreach($order->orderItems as $item)

                    <div
                        class="rounded-2xl border border-stone-200 p-5 flex justify-between items-center hover:shadow-sm transition">

                        <div>

                            <p class="font-semibold text-lg">
                                {{ $item->dish->name }}
                            </p>

                            <p class="text-stone-500 mt-1">
                                Quantity × {{ $item->quantity }}
                            </p>

                        </div>

                        <p class="text-xl font-bold text-orange-500">
                            ${{ number_format($item->price,2) }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

        {{-- ===================================== --}}
        {{-- RIGHT COLUMN --}}
        {{-- ===================================== --}}

        <div class="lg:col-span-4 p-8 bg-stone-50">

            <div class="flex justify-between items-center mb-8">

                <span
                    id="order-status-{{ $order->id }}"
                    class="px-5 py-2 rounded-full text-sm font-semibold

                    @if($order->status=='pending')
                        bg-gray-200 text-gray-700
                    @elseif($order->status=='preparing')
                        bg-yellow-100 text-yellow-700
                    @elseif($order->status=='completed')
                        bg-green-100 text-green-700
                    @else
                        bg-red-100 text-red-700
                    @endif">

                    {{ ucfirst($order->status) }}

                </span>

                <span
                    class="bg-white rounded-xl px-4 py-2 text-stone-400 font-semibold">

                    #ORD-{{ $order->id }}

                </span>

            </div>

            <div id="order-actions-{{ $order->id }}">

                @include('admin.orders.partials.actions')

            </div>

        </div>

    </div>

</div>