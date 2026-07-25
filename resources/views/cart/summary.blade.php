<div class="bg-white shadow-lg rounded-3xl p-8 sticky top-28">

    <h2 class="text-3xl text-neutral-900 font-bold mb-6">
        {{ __('cart.summary') }}
    </h2>
    
    <div class="flex justify-between text-gray-500 mb-6">

        <span>{{ __('cart.total_items') }}</span>

        <span id="cart-items-count">
            {{ count($cart) }}
        </span>

    </div>

    <div class="flex justify-between text-neutral-800 text-2xl font-bold mb-10">

        <span>{{ __('cart.total') }}</span>

        <span id="cart-total" class="text-orange-500">
            ${{ $total }}
        </span>

    </div>

    <a href="{{ route('checkout.show') }}"
        class="block text-center w-full
            bg-orange-500 hover:bg-orange-600
            hover:shadow-lg hover:shadow-orange-500/30
            text-white py-3 rounded-2xl
            font-semibold transition duration-300">
        {{ __('cart.checkout') }}
    </a>

</div>