@forelse($cart as $id => $item)

    <div id="cart-item-{{ $id }}" class="bg-white shadow-lg rounded-3xl p-6 flex gap-6 items-center">

        <img src="{{ asset('storage/' . $item['image']) }}" class="w-32 h-32 object-cover rounded-2xl">

        <div class="flex-1">

            <div class="flex justify-between mb-8">

                <h2 class="text-2xl text-neutral-800 font-bold">
                    {{ $item['name'] }}
                </h2>

                <span class="text-orange-400 font-bold text-xl">
                    ${{ $item['price'] }}
                </span>
                
            </div>

            <div class="flex justify-between">

                <button
                    type="button"
                    class="cart-remove text-red-500 font-semibold hover:text-red-300 transition"
                    data-id="{{ $id }}">
                    {{ __('cart.remove') }}
                </button>

                <div class="flex items-center gap-3">

                    <button
                        type="button"
                        class="cart-decrease w-8 h-8 rounded-full bg-stone-300 hover:bg-stone-400 text-white font-bold"
                        data-id="{{ $id }}">
                        -
                    </button>

                    <span class="text-lg font-semibold">
                        {{ $item['quantity'] }}
                    </span>

                    <button
                        type="button"
                        class="cart-increase w-8 h-8 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold"
                        data-id="{{ $id }}">
                        +
                    </button>

                </div>

            </div>

        </div>

    </div>

@empty

    <div class="empty-cart-template" class="hidden">
        @include('cart.empty')
    </div>

@endforelse