@forelse($cart as $id => $item)

    <div id="cart-item-{{ $id }}" class="bg-white shadow-lg rounded-3xl sm:p-6 p-4 flex gap-6 items-center">

        <img src="{{ asset('storage/' . $item['image']) }}" class="sm:w-32 sm:h-32 w-24 h-24 object-cover rounded-2xl">

        <div class="flex-1">

            <div class="flex justify-between gap-3 sm:mb-12 mb-8">

                <h2 class="flex-1 min-w-0 sm:text-2xl text-xl text-neutral-800 font-bold line-clamp-2">
                    {{ $item['name'] }}
                </h2>
            
                <button
                    type="button"
                    class="cart-remove shrink-0 text-red-500 font-semibold hover:text-red-300 transition"
                    data-id="{{ $id }}">
                    <i data-lucide="circle-x" class="w-6 h-6"></i>
                </button>
            
            </div>

            <div class="flex justify-between">

                <span class="text-orange-500 font-bold text-lg sm:text-xl">
                    {{ $item['price'] }} TMT
                </span>
                
                <div class="flex items-center gap-3">

                    <button
                        type="button"
                        class="cart-decrease sm:w-8 sm:h-8 w-6 h-6 rounded-full bg-stone-300 hover:bg-stone-400 text-white font-bold"
                        data-id="{{ $id }}">
                        -
                    </button>

                    <span class="text-lg font-semibold">
                        {{ $item['quantity'] }}
                    </span>

                    <button
                        type="button"
                        class="cart-increase sm:w-8 sm:h-8 w-6 h-6 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold"
                        data-id="{{ $id }}">
                        +
                    </button>

                </div>

            </div>

        </div>

    </div>

@empty

    <div class="empty-cart-template">
        @include('cart.empty')
    </div>

@endforelse