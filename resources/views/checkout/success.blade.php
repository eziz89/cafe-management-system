@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-stone-100 flex items-center justify-center py-20">

    <div class="max-w-3xl w-full bg-white rounded-[3rem] shadow-2xl overflow-hidden">

        {{-- Success Header --}}

        <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-center py-14">

            <div class="text-6xl mb-5">
                🎉
            </div>

            <h1 class="text-5xl font-bold">
                Order Successfully Placed!
            </h1>

            <p class="mt-5 text-lg opacity-90">
                Thank you, {{ $order->customer_name }}!
            </p>

        </div>

        {{-- Body --}}

        <div class="p-10">

            <p class="text-center text-stone-500 text-lg leading-relaxed mb-10">
                We have received your order and our kitchen has already started preparing it.
            </p>

            {{-- Order Info --}}

            <div class="grid md:grid-cols-2 gap-8">

                <div class="space-y-5">

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Order Number
                        </p>

                        <p class="font-bold text-2xl">
                            #{{ $order->id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Status
                        </p>

                        <span class="inline-block mt-2 bg-gray-200 text-gray-700 px-4 py-2 rounded-full">

                            Pending

                        </span>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Order Type
                        </p>

                        <p class="mt-2 font-semibold">

                            @if($order->order_type=='delivery')
                                🚚 Delivery
                            @elseif($order->order_type=='takeaway')
                                🥡 Take Away
                            @else
                                🍽 Eat In
                            @endif

                        </p>
                    </div>

                    <div>
                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Payment
                        </p>

                        <p class="mt-2 font-semibold">

                            @if($order->payment_method=='cash')
                                💵 Cash on Delivery
                            @else
                                💳 Card on Delivery
                            @endif

                        </p>
                    </div>

                </div>

                <div class="space-y-5">

                    @if($order->order_type=='delivery')

                    <div>

                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Delivery Address
                        </p>

                        <p class="mt-2 font-semibold">
                            📍 {{ $order->customer_address }}
                        </p>

                    </div>

                    @endif

                    <div>

                        <p class="text-xs uppercase tracking-widest text-stone-400">
                            Total
                        </p>

                        <p class="text-4xl font-bold text-orange-500 mt-2">
                            ${{ number_format($order->total_price,2) }}
                        </p>

                    </div>

                </div>

            </div>

            {{-- Timeline --}}

            <div class="mt-12 rounded-3xl bg-orange-50 border border-orange-200 p-8">

                <h2 class="font-bold text-xl mb-5">
                    What happens next?
                </h2>

                <div class="space-y-4 text-stone-600">

                    <p>🍳 Your food is being prepared.</p>

                    <p>📞 We'll contact you if we need additional information.</p>

                    <p>🚚 Estimated preparation time: <strong>20–30 minutes</strong>.</p>

                </div>

            </div>

            {{-- Buttons --}}

            <div class="flex flex-col sm:flex-row justify-center gap-5 mt-12">

                <a
                    href="{{ route('orders.my') }}"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-semibold transition text-center">

                    View My Orders

                </a>

                <a
                    href="{{ route('menu.index') }}"
                    class="border border-stone-300 hover:bg-stone-100 px-8 py-4 rounded-2xl font-semibold transition text-center">

                    Continue Browsing

                </a>

            </div>

            <p class="text-center text-stone-400 mt-10">

                ❤️ Thank you for choosing our canteen!

            </p>

        </div>

    </div>

</section>

@endsection