<div id="order-{{ $order->id }}" class="relative bg-white rounded-2xl sm:rounded-3xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden mb-6 sm:mb-8">

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

        <div class="lg:col-span-3 p-5 sm:p-8 border-b lg:border-b-0 lg:border-r border-stone-200">

            <div class="flex items-center gap-4">

                <div class="flex items-center gap-3 sm:gap-4">

                    <div class="w-12 h-12 sm:w-16 sm:h-16 rounded-2xl bg-orange-50 flex items-center justify-center">
                        <i data-lucide="package" class="w-6 h-6 sm:w-8 sm:h-8 text-orange-500"></i>
                    </div>
                
                    <div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-stone-800">
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

            </div>

            <hr class="my-6">

            <div class="space-y-5">

                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Müşderi
                        </p>

                        @if($order->user)
                            <span class="font-semibold">
                                {{ $order->user->name }}
                            </span>
                        @else
                            <div class="font-semibold">
                                {{ $order->customer_name }}
                            </div>
                        
                            <span class="ml-2 text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">
                                Myhman
                            </span>
                        @endif
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Sargyt görnüşi
                        </p>

                        <p class="font-semibold text-lg mt-2">

                            @if($order->order_type === 'delivery')

                                Eltip bermek

                            @elseif($order->order_type === 'takeaway')
                                
                                Alyp gitmek üçin

                            @else

                                Ýerinde iýmek

                            @endif

                        </p>
                    </div>
                    
                </div>

                
                <div class="flex justify-between items-center">

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Telefon
                        </p>

                        <p class="font-semibold text-lg mt-2">
                            {{ $order->customer_phone }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Töleg
                        </p>

                        <p class="font-semibold text-lg mt-2">

                            @if($order->payment_method === 'cash')

                                <div class="flex items-center gap-2 font-semibold text-lg">
                                    <i data-lucide="banknote" class="w-5 h-5"></i>
                                    Nagt
                                </div>

                            @else

                                <div class="flex items-center gap-2 font-semibold text-lg">
                                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                                    Kart
                                </div>

                            @endif

                        </p>
                    </div>
                
                </div>

                
                <div class="flex justify-between items-center">
                    @if($order->order_type === 'delivery')
                    
                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                            Eltip bermek salgysy
                        </p>
                    
                        <p class="flex items-center gap-1 font-semibold mt-2">
                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                            {{ $order->customer_address }}
                        </p>
                        </div>
                    
                    @endif
    
                    
                    @if($order->notes)
    
                        <div>
                            <p class="text-xs uppercase tracking-widest text-stone-400">
                                Bellikler
                            </p>
    
                            <p class="font-semibold text-lg mt-2">
                                {{ $order->notes }}
                            </p>
                        </div>
    
                    @endif
                </div>
            </div>

        </div>

        {{-- ===================================== --}}
        {{-- MIDDLE COLUMN --}}
        {{-- ===================================== --}}

        <div class="lg:col-span-5 p-5 sm:p-8 border-b lg:border-b-0 lg:border-r border-stone-200">

            <h3 class="font-bold text-xl mb-6">

                Sargyt edilen tagamlar

                <span class="text-stone-400 text-base">
                    ({{ $order->orderItems->count() }})
                </span>

            </h3>

            <div class="space-y-4 max-h-70 overflow-y-auto scrollbar-thin pr-2 mb-4">

                @foreach($order->orderItems as $item)

                    <div class="rounded-2xl border border-stone-200 p-3 sm:p-5 flex items-center justify-between gap-3">

                        <div class="flex items-center gap-2 sm:gap-4 min-w-0">

                            <img
                                src="{{ asset('storage/' . $item->dish->image) }}"
                                alt="{{ $item->dish->name }}"
                                class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl object-cover shrink-0">

                            <div class="min-w-0">

                                <p class="font-semibold text-sm sm:text-lg truncate">
                                    {{ $item->dish->name }}
                                </p>

                                <p class="text-stone-500 text-xs sm:text-base mt-1">
                                    Mukdar × {{ $item->quantity }}
                                </p>

                            </div>

                        </div>

                        <p class="text-base sm:text-xl font-bold text-orange-500 whitespace-nowrap shrink-0">
                            {{ number_format($item->price * $item->quantity, 2) }} TMT
                        </p>

                    </div>

                @endforeach

            </div>

            <div class="rounded-2xl border border-green-300 bg-green-200 py-3 px-4 sm:px-5 flex justify-between items-center gap-3">

                <p class="font-semibold tracking-wide sm:tracking-widest text-green-600">
                    Jemi möçber
                </p>

                <p class="text-xl sm:text-2xl font-bold text-green-600 whitespace-nowrap">
                    {{ number_format($order->total_price, 2) }} TMT
                </p>

            </div>


        </div>

        {{-- ===================================== --}}
        {{-- RIGHT COLUMN --}}
        {{-- ===================================== --}}

        <div class="lg:col-span-4 p-5 sm:p-8 bg-stone-50">

            <div class="flex flex-wrap justify-between items-center gap-3 mb-6 sm:mb-8">

                <span id="order-status-{{ $order->id }}" class="px-5 rounded-full text-sm font-semibold">

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

                </span>

                <span class="bg-white rounded-xl px-3 sm:px-4 py-2 text-stone-400 text-sm sm:text-base font-semibold">
                    #ORD-{{ $order->id }}
                </span>

            </div>

            <div id="order-actions-{{ $order->id }}">

                @include('admin.orders.partials.actions', ['order' => $order])

            </div>

        </div>

    </div>

</div>