@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-stone-100 flex items-center justify-center sm:py-14 py-10 px-6 sm:px-0">

    <div class="max-w-3xl w-full bg-white rounded-[3rem] shadow-xl overflow-hidden">

        {{-- Success Header --}}

        <div class="flex flex-col items-center bg-gradient-to-r from-green-500 to-emerald-500 text-white text-center sm:py-14 py-10">

            <div class="bg-green-300 rounded-full text-5xl sm:mb-5 mb-4 p-4">
                <i data-lucide="check" class="sm:w-8 w-6 h-6 sm:h-8 w-6 h-6 text-green-600"></i>
            </div>

            <h1 class="sm:text-5xl text-4xl font-bold">
                {{ __('checkoutsuccess.placed') }}
            </h1>

            <p class="mt-5 text-lg opacity-90">
                {{ __('checkoutsuccess.thank_you_customer') }} {{ $order->customer_name }}!
            </p>

        </div>

        {{-- Body --}}

        <div class="sm:p-10 p-6">

            <p class="text-center text-stone-500 text-lg leading-relaxed sm:mb-10 mb-6">
                {{ __('checkoutsuccess.info') }}
            </p>

            {{-- Order Info --}}

            <div class="grid md:grid-cols-2 gap-8 sm:mb-8 mb-6">

                <div class="space-y-5">

                    <div>
                        
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.order_number') }}
                        </p>

                        <p class="font-bold text-2xl">
                            #{{ $order->id }}
                        </p>

                    </div>

                    <div>

                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.status') }}
                        </p>

                        <span class="inline-block mt-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-full">

                            @if($order->status === 'pending')
                                <span class="bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    {{ __('status.pending') }}
                                </span>
    
                            @elseif($order->status === 'preparing')
                                <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    {{ __('status.preparing') }}
                                </span>
    
                            @elseif($order->status === 'completed')
                                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    {{ __('status.completed') }}
                                </span>
    
                            @elseif($order->status === 'cancelled')
                                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
                                    {{ __('status.cancelled') }}
                                </span>
    
                            @endif
                            
                        </span>

                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.items') }}
                        </p>

                        <p class="mt-2 font-semibold">
                            {{ trans_choice('checkoutsuccess.item_count', $order->orderItems->sum('quantity'), ['count' => $order->orderItems->sum('quantity')]) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.dishes') }}
                        </p>

                        <p class="mt-2 font-semibold">
                            {{ trans_choice('checkoutsuccess.dish_count', $order->orderItems->count(), ['count' => $order->orderItems->count()]) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.order_type') }}
                        </p>

                        <p class="mt-2 font-semibold">

                            @if($order->order_type=='delivery')
                                <div class="flex items-center gap-2">
                                    <i data-lucide="truck" class="w-5 h-5"></i>
                                    {{ __('checkout.delivery') }}
                                </div>
                            @elseif($order->order_type=='takeaway')
                                <div class="flex items-center gap-2">
                                    <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                                    {{ __('checkout.take_away') }}
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <i data-lucide="utensils" class="w-5 h-5"></i>
                                    {{ __('checkout.eat_in') }}
                                </div>
                            @endif

                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.payment') }}
                        </p>

                        <p class="mt-2 font-semibold">

                            @if($order->payment_method=='cash')
                                <div class="flex items-center gap-2">
                                    <i data-lucide="banknote" class="w-5 h-5"></i>
                                    {{ __('checkout.cash') }}
                                </div>
                            @else
                                <div class="flex items-center gap-2">
                                    <i data-lucide="credit-card" class="w-5 h-5"></i>
                                    {{ __('checkout.card') }}
                                </div>
                            @endif

                        </p>
                    </div>

                </div>

                <div class="space-y-5">

                    @if($order->order_type=='delivery')

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkout.delivery_address') }}
                        </p>

                        <p class="mt-2 font-semibold">
                            <div class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                                {{ $order->customer_address }}
                            </div>
                        </p>
                    </div>

                    @endif

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            {{ __('checkoutsuccess.total') }}
                        </p>

                        <p class="sm:text-4xl text-3xl font-bold text-orange-500 mt-2">
                            {{ number_format($order->total_price,2) }} TMT
                        </p>
                    </div>

                </div>

            </div>

            @if(auth()->check())

                <p class="text-gray-600">
                    {{ __('checkoutsuccess.track') }}
                    <a href="{{ route('orders.my') }}"
                       class="text-orange-600 font-semibold">
                        {{ __('checkoutsuccess.my_orders') }}
                    </a>.
                </p>

            @else

                <p class="text-gray-600">
                    {{ __('checkoutsuccess.info_2') }}
                </p>

                <div class="mt-6 rounded-3xl bg-orange-50 sm:p-8 p-6 border border-orange-200">

                    <h3 class="font-semibold text-orange-700 text-xl">
                        {{ __('checkoutsuccess.ask_live_ordering') }}
                    </h3>

                    <p class="text-gray-600 mt-2">
                        {{ __('checkoutsuccess.create_account_to') }}
                    </p>

                    <ul class="list-disc ml-6 mt-2 text-gray-700">
                        <li>{{ __('checkoutsuccess.track_orders') }}</li>
                        <li>{{ __('checkoutsuccess.view_history') }}</li>
                        <li>{{ __('checkoutsuccess.notifications') }}</li>
                    </ul>

                    <a href="{{ route('register') }}" class="inline-block mt-4 sm:px-5 px-4 sm:py-2 py-1 bg-orange-600 text-white rounded-xl hover:bg-orange-700">

                        {{ __('checkoutsuccess.create_account') }}

                    </a>

                </div>

            @endif

            {{-- Timeline --}}

            <div class="mt-4 rounded-3xl bg-orange-50 border border-orange-200 sm:p-8 p-6">

                <h2 class="font-bold text-xl mb-5">
                    {{ __('checkoutsuccess.next') }}
                </h2>

                <div class="space-y-4 text-stone-600">

                    <div class="flex items-center gap-2">
                        <i data-lucide="cooking-pot" class="w-5 h-5"></i>
                        {{ __('checkoutsuccess.food') }}
                    </div>

                    <div class="flex items-center gap-2">
                        <i data-lucide="phone" class="w-5 h-5"></i> 
                        {{ __('checkoutsuccess.contact') }}
                    </div>

                    <div class="flex items-center gap-2">
                        <i data-lucide="clock-3" class="w-5 h-5"></i>
                        <div>
                            {{ __('checkoutsuccess.preparation_time') }}
                        <strong>{{ __('checkoutsuccess.time') }}</strong>
                        </div>
                    </div>

                </div>

            </div>

            {{-- Buttons --}}

            <div class="flex flex-col sm:flex-row justify-center sm:gap-6 gap-4 mt-6">

                @auth

                    <a href="{{ route('orders.my') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-8 sm:py-4 py-3 rounded-2xl font-semibold transition text-center">
                        {{ __('checkoutsuccess.view_my_orders') }}
                    </a>

                @endauth

                <a
                    href="{{ route('menu.index') }}"
                    class="border border-stone-300 hover:bg-stone-100 px-8 sm:py-4 py-3 rounded-2xl font-semibold transition text-center">

                    {{ __('checkoutsuccess.browse') }}

                </a>

            </div>

            <p class="flex items-center gap-2 justify-center text-stone-400 sm:mt-10 mt-4">

                <i data-lucide="heart" class="w-5 h-5 text-red-500"></i>
                {{ __('checkoutsuccess.thank_you') }}

            </p>

        </div>

    </div>

</section>

@endsection