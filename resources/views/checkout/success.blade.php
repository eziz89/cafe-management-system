@extends('layouts.app')

@section('content')

<section class="min-h-screen bg-stone-100 flex items-center justify-center px-6">

    <div class="max-w-2xl w-full bg-white rounded-[3rem] shadow-2xl p-14 text-center">
        <div class="w-28 h-28 mx-auto rounded-full bg-green-100 flex items-center justify-center text-5xl mb-10">
            ✅
        </div>
        <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-4">
            Order Completed
        </p>
        <h1 class="text-5xl font-bold text-stone-800 mb-8">
            Thank You For Your Order!
        </h1>
        <p class="text-stone-500 text-lg leading-relaxed mb-12">
            Your order has been successfully placed. Our team is preparing your delicious meals and will process your request shortly.
        </p>
        <div class="flex justify-center gap-4">
            <a href="/categories" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-semibold transition">
                Continue Browsing
            </a>
            <a href="/" class="border border-stone-300 hover:bg-stone-100 px-8 py-4 rounded-2xl font-semibold transition">
                Back Home
            </a>
        </div>
    </div>

</section>

@endsection