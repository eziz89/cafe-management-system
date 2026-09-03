@extends('layouts.app')

@section('content')

<div class="bg-stone-50 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0 py-10">

        <div class="sm:mb-8 mb-6">

            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold">
                {{ __('checkout.checkout') }}
            </p>

            <h1 class="text-4xl font-bold text-stone-900 mt-2">
                {{ __('checkout.complete_your_order') }}
            </h1>

            <p class="text-stone-500 mt-3">
                {{ __('checkout.info') }}
            </p>

        </div>

        <form action="{{ route('checkout') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Customer information --}}

                <div class="lg:col-span-2">

                    <div class="bg-white rounded-3xl shadow-lg p-8">

                        <div class="sm:mb-6 mb-4">

                            <div>
                                <h2 class="text-2xl font-bold sm:mb-2">
                                    {{ __('checkout.customer_information') }}
                                </h2>

                                <p class="text-stone-500">
                                    {{ __('checkout.details') }}
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
                                {{ __('checkout.full_name') }}
                            </label>

                            <input
                                name="customer_name"
                                value="{{ old('customer_name', session('checkout.customer_name')) }}"
                                class="w-full rounded-2xl border border-orange-400 px-5 py-4
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
                                {{ __('checkout.phone_number') }}
                            </label>

                            <div class="flex rounded-2xl border border-orange-400">

                                <span class="flex items-center px-4 rounded-l-2xl text-stone-600">
                                    +993
                                </span>

                                <input
                                    type="tel"
                                    name="customer_phone"
                                    value="{{ old('customer_phone', session('checkout.customer_phone')) }}"
                                    placeholder="61 00 00 00"
                                    class="flex-1 rounded-r-2xl px-5 py-4
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
                                {{ __('checkout.order_type') }}
                            </label>

                            <div class="space-y-3">

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="order_type"
                                        value="delivery"
                                        @checked(old('order_type', session('checkout.order_type', 'delivery')) === 'delivery')
                                        class="text-orange-500">

                                    {{ __('checkout.delivery') }}

                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="order_type"
                                        value="takeaway"
                                        @checked(old('order_type', session('checkout.order_type')) === 'takeaway')
                                        class="text-orange-500">

                                    {{ __('checkout.take_away') }}

                                </label>

                                <label class="flex items-center gap-3 cursor-pointer">

                                    <input
                                        type="radio"
                                        name="order_type"
                                        value="eat_in"
                                        @checked(old('order_type', session('checkout.order_type')) === 'eat_in')
                                        class="text-orange-500">

                                    {{ __('checkout.eat_in') }}

                                </label>

                            </div>

                        </div>

                        <div class="mb-6">
                        
                            <label class="block font-semibold mb-3">
                                {{ __('checkout.payment_method') }}
                            </label>
                        
                            <div class="space-y-3">
                        
                        
                                <label class="flex items-center gap-3 cursor-pointer">
                        
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="cash"
                                        @checked(old('payment_method', session('checkout.payment_method', 'cash')) === 'cash')
                                        class="text-orange-500">
                        
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="banknote" class="w-5 h-5"></i>{{ __('checkout.cash') }}
                                    </div>
                        
                                </label>
                        
                                <label class="flex items-center gap-3 cursor-pointer">
                        
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="card"
                                        @checked(old('payment_method', session('checkout.payment_method')) === 'card')
                                        class="text-orange-500">
                        
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="credit-card" class="w-5 h-5"></i> {{ __('checkout.card') }}
                                    </div>

                                </label>
                        
                            </div>
                        
                        </div>

                        <div id="address-section" class="mb-5">

                            <label class="block font-semibold mb-2">
                                {{ __('checkout.delivery_address') }}
                            </label>

                            <input
                                type="text"
                                name="customer_address"
                                value="{{ old('customer_address', session('checkout.customer_address')) }}"
                                placeholder="{{ __('checkout.street_building_apartment') }}"
                                class="w-full rounded-2xl border border-orange-400 px-5 py-4
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
                                {{ __('checkout.special_notes') }}
                            </label>

                            <textarea
                                name="notes"
                                rows="3"
                                placeholder="{{ __('checkout.example') }}"
                                class="w-full rounded-2xl px-5 py-4 border border-orange-400 focus:ring-2 focus:ring-orange-300">{{ old('notes', session('checkout.notes')) }}</textarea>

                            @error('notes')

                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                            
                            @enderror

                        </div>

                        <div class="mt-6 bg-orange-50 border border-orange-200 rounded-2xl p-5">

                            <div class="flex items-center gap-1 text-orange-700 font-semibold">
                                <i data-lucide="triangle-alert" class="w-5 h-5"></i> {{ __('checkout.important') }}
                            </div>
                                
                            <p class="text-stone-600 mt-1">
                                {{ __('checkout.important_note') }}
                            </p>

                        </div>

                    </div>

                </div>

                {{-- Summary --}}

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-6 lg:sticky lg:top-28">

                        <h2 class="text-2xl font-bold mb-6">
                            {{ __('checkout.order_summary') }}
                        </h2>

                        <div class="space-y-5">

                            @foreach($cart as $item)

                                <div class="flex items-center gap-4">

                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 rounded-xl object-cover">
                                
                                    <div class="flex-1">    

                                        <p class="font-semibold">
                                            {{ $item['name'] }}
                                        </p>

                                        <p class="text-stone-500 text-sm">
                                            {{ __('checkout.quantity') }} × {{ $item['quantity'] }}
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

                                <span class="font-bold text-2xl text-stone-900">
                                    {{ __('checkout.total') }}
                                </span>

                                <span class="font-bold text-2xl text-orange-500">
                                    ${{ number_format($total,2) }}
                                </span>

                            </div>

                        </div>

                        <button class="w-full mt-4 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-2xl transition shadow-lg flex items-center justify-center gap-2">
                            
                            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                            <span>{{ __('checkout.place_order') }}</span>

                        </button>

                        <div class="flex items-center justify-center gap-2 text-sm text-stone-500 mt-5">
                            
                            <i data-lucide="lock" class="w-5 h-5"></i>
                            <span>{{ __('checkout.order_will_sent') }}</span>
                            
                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection