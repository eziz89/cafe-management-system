<div class="bg-white shadow-lg rounded-3xl sm:p-8 p-6 lg:sticky lg:top-28">

    <h2 class="sm:text-3xl text-2xl text-neutral-900 font-bold mb-6">
        {{ __('cart.summary') }}
    </h2>
    
    <div class="flex justify-between text-gray-500 mb-6">

        <span>{{ __('cart.total_items') }}</span>

        <span id="cart-items-count">
            {{ collect($cart)->sum('quantity') }}
        </span>

    </div>

    <div class="flex justify-between text-neutral-800 sm:text-2xl text-xl font-bold sm:mb-10 mb-6">

        <span>{{ __('cart.total') }}</span>

        <span id="cart-total" class="text-orange-500">
            ${{ $total }}
        </span>

    </div>

    <a href="{{ route('checkout.show') }}"
        class="block text-center w-full
            bg-orange-500 hover:bg-orange-600
            hover:shadow-lg hover:shadow-orange-500/30
            text-white sm:py-3 py-2 rounded-2xl
            font-semibold transition duration-300">
        {{ __('cart.checkout') }}
    </a>

</div>