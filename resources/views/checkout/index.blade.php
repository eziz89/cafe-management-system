@extends('layouts.app')

@section('content')

<div class="bg-stone-100 min-h-screen py-12">

    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-10">

            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold">
                Checkout
            </p>

            <h1 class="text-4xl font-bold text-stone-900 mt-2">
                Complete Your Order
            </h1>

            <p class="text-stone-500 mt-3">
                Provide your information and confirm your order.
            </p>

        </div>


        <form action="{{ route('checkout') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Customer information --}}

                <div class="lg:col-span-2">

                    <div class="bg-white rounded-3xl shadow-lg p-8">

                        <div class="flex items-center gap-3 mb-8">

                            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center">
                                👤
                            </div>

                            <div>
                                <h2 class="text-2xl font-bold">
                                    Customer Information
                                </h2>

                                <p class="text-stone-500">
                                    Please provide your details.
                                </p>
                            </div>

                        </div>

                        @if ($errors->any())

                        <div class="bg-red-50 border border-red-200 rounded-2xl p-5 mb-6">

                            <h3 class="font-bold text-red-700 mb-2">
                                Please fix the following:
                            </h3>

                            <ul class="list-disc ml-5 text-red-600">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                        @endif

                        {{-- Name --}}

                        <div class="mb-5">

                            <label class="block font-semibold mb-2">
                                Full Name *
                            </label>


                            <input
                                name="customer_name"
                                value="{{ old('customer_name', session('checkout.customer_name')) }}"
                                class="w-full rounded-2xl px-5 py-4
                                @error('customer_name')
                                    border-red-500
                                @enderror"
                                required>

                            @error('customer_name')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        {{-- Phone --}}

                        <div class="mb-5">

                            <label class="block font-semibold mb-2">
                                Phone Number *
                            </label>

                            <div class="flex">

                                <span class="flex items-center px-4 rounded-l-2xl text-stone-600">
                                    +993
                                </span>

                                <input
                                    type="tel"
                                    name="customer_phone"
                                    value="{{ old('customer_phone', session('checkout.customer_phone')) }}"
                                    placeholder="61 00 00 00"
                                    class="flex-1 rounded-r-2xl border-stone-200 px-5 py-4
                                    @error('customer_phone')
                                        border-red-500
                                    @enderror"
                                    required>

                            </div>
                            
                            @error('customer_phone')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror
                            
                        </div>

                        <div class="mb-6">

                            <label class="block font-semibold mb-3">
                                Order Type *
                            </label>

                            <div class="space-y-3">

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="order_type"
                                        value="delivery"
                                        @checked(old('order_type', session('checkout.order_type', 'delivery')) === 'delivery')
                                        class="text-orange-500">

                                    Delivery

                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="order_type"
                                        value="takeaway"
                                        @checked(old('order_type', session('checkout.order_type')) === 'takeaway')
                                        class="text-orange-500">

                                    Take Away

                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="order_type"
                                        value="eat_in"
                                        @checked(old('order_type', session('checkout.order_type')) === 'eat_in')
                                        class="text-orange-500">

                                    Eat In

                                </label>

                            </div>

                        </div>

                        <div class="mb-6">
                        
                            <label class="block font-semibold mb-3">
                                Payment Method *
                            </label>
                        
                            <div class="space-y-3">
                        
                        
                                <label class="flex items-center gap-3 cursor-pointer">
                        
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="cash"
                                        @checked(old('payment_method', session('checkout.payment_method', 'cash')) === 'cash')
                                        class="text-orange-500">
                        
                                    💵 Cash on Delivery
                        
                                </label>
                        
                                <label class="flex items-center gap-3 cursor-pointer">
                        
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="card"
                                        @checked(old('payment_method', session('checkout.payment_method')) === 'card')
                                        class="text-orange-500">
                        
                                    💳 Card on Delivery
                        
                                </label>
                        
                            </div>
                        
                        </div>

                        <div id="address-section" class="mb-5">

                            <label class="block font-semibold mb-2">
                                Delivery Address *
                            </label>

                            <input
                                type="text"
                                name="customer_address"
                                value="{{ old('customer_address', session('checkout.customer_address')) }}"
                                placeholder="Street, building, apartment"
                                class="w-full rounded-2xl px-5 py-4
                                @error('customer_address')
                                    border-red-500
                                @enderror">

                            @error('customer_address')

                                <p class="text-red-500 text-sm mt-2">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                        {{-- Notes --}}

                        <div>

                            <label class="block font-semibold mb-2">
                                Special Notes (optional)
                            </label>

                            <textarea
                                name="notes"
                                rows="3"
                                placeholder="Example: No onions, extra spicy..."
                                class="w-full rounded-2xl px-5 py-4 focus:ring-2 focus:ring-orange-300">{{ old('notes', session('checkout.notes')) }}</textarea>

                            @error('notes')

                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                            
                            @enderror

                        </div>

                        <div class="mt-8 bg-orange-50 border border-orange-200 rounded-2xl p-5">

                            <p class="text-orange-700 font-semibold">
                                ⚠ Important
                            </p>

                            <p class="text-stone-600 mt-1">
                                Your order will only be sent after you press "Place Order".
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Summary --}}

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-28">

                        <h2 class="text-2xl font-bold mb-6">
                            Order Summary
                        </h2>

                        <div class="space-y-5">

                            @foreach($cart as $item)

                                <div class="flex items-center gap-4">

                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-14 h-14 rounded-xl object-cover">
                                
                                    <div class="flex-1">

                                        <p class="font-semibold">
                                            {{ $item['name'] }}
                                        </p>

                                        <p class="text-stone-500 text-sm">
                                            Quantity × {{ $item['quantity'] }}
                                        </p>

                                    </div>

                                    <p class="font-semibold">
                                        ${{ number_format($item['price'] * $item['quantity'],2) }}
                                    </p>

                                </div>

                            @endforeach

                        </div>

                        <div class="border-t border-stone-300 mt-6 pt-6">

                            <div class="flex justify-between text-lg">

                                <span>
                                    Total
                                </span>

                                <span class="font-bold text-2xl text-orange-500">
                                    ${{ number_format($total,2) }}
                                </span>

                            </div>

                        </div>

                        <button class="w-full mt-8 bg-orange-500 hover:bg-orange-600 text-white font-bold py-4 rounded-2xl transition shadow-lg">
                            🛒 Place Order
                        </button>

                        <p class="text-center text-sm text-stone-500 mt-5">
                            🔒 Your order will be sent securely.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection