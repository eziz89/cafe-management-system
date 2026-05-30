@extends('layouts.app')

@section('content')
<div class="bg-gray-50">
    <div class="max-w-7x mx-aut pb-24">
        <section class="relative">

            <img src="{{ asset('images/menu-header.jpg') }}" alt="Our Menu" class="w-full h-92 object-cover">

            <div class="absolute inset-0 bg-black/40 bg-gradient-to-r from-black/70 to-black/20 flex items-center pt-24">

                <div class="px-12 text-white">

                    <p class="uppercase tracking-[0.3em] text-orange-300 font-semibold">
                        MENU
                    </p>

                    <h1 class="text-5xl font-bold mt-4">
                        Discover Our Delicious Dishes
                    </h1>

                    <p class="mt-4 text-lg max-w-xl text-gray-200">
                        Fresh ingredients, authentic recipes, and unforgettable flavors.
                    </p>

                </div>

            </div>

        </section>

        <section class="py-20 bg-gray-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="grid lg:grid-cols-4 gap-10">    

                    {{-- SIDEBAR --}}
                    <div class="lg:col-span-1">

                        <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-24 h-fit">

                            <h2 class="text-2xl font-bold mb-6">
                                Categories
                            </h2>

                            <div class="space-y-3">

                                <a href="/menu"
                                class="flex items-center justify-between px-4 py-3 rounded-2xl bg-orange-100 text-orange-600 font-semibold">

                                    <span>All Dishes</span>

                                    <span>{{ $dishes->count() }}</span>

                                </a>

                                @foreach($categories as $category)

                                    <a href="{{ route('categories.show', $category->id) }}"
                                    class="flex items-center justify-between pr-4 pl-5 py-3 rounded-2xl hover:bg-orange-50 hover:text-orange-500 transition">

                                        <span>{{ $category->name }}</span>

                                        <span class="text-gray-400">
                                            {{ $category->dishes_count }}
                                        </span>

                                    </a>

                                @endforeach

                            </div>

                        </div>

                    </div>

                    {{-- DISHES --}}
                    <div class="lg:col-span-3">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-4">

                            <div>

                                <h2 class="text-4xl font-bold text-gray-900 mb-2">
                                    All Dishes
                                </h2>

                                <p class="text-gray-500">
                                    Showing {{ $dishes->count() }} delicious items
                                </p>

                            </div>

                            {{-- SORT --}}

                            <select class="bg-white border border-gray-200 rounded-2xl px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-300">
                                
                                <option>Newest</option>
                                <option>Price Low to High</option>
                                <option>Price High to Low</option>
                                <option>Top Rated</option>

                            </select>

                        </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                                @if($dishes->isEmpty())
                                    <p>No dishes available yet.</p>
                                @else

                                    @foreach($dishes as $dish)

                                        <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300 flex flex-col">

                                            <a href="/menu/{{ $dish->id }}" class="overflow-hidden">
                                                @if($dish->image)
                                                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-56 object-cover hover:scale-105 transition duration-500">
                                                @endif
                                            </a>

                                            <div class="p-6 flex flex-col flex-grow">

                                                <div class="flex justify-between items-start gap-4 mb-3">
                                                    <a href="/menu/{{ $dish->id }}">
                                                        <h3 class="text-2xl font-bold text-gray-800 hover:text-orange-500 transition">
                                                            {{ $dish->name }}
                                                        </h3>
                                                    </a>

                                                    <span class="text-orange-500 font-bold text-xl whitespace-nowrap">
                                                        ${{ number_format($dish->price, 2) }}
                                                    </span>

                                                </div>

                                                <p class="text-gray-500 leading-relaxed mb-5">
                                                    {{ Str::limit($dish->description, 75) }}
                                                </p>

                                                <div class="flex justify-between items-center mb-6">

                                                    @if($dish->category)
                                                        <a href="{{ route('categories.show', $dish->category->id) }}" class="inline-flex items-center bg-orange-100 text-orange-700 text-sm font-medium rounded-full px-3 py-1 hover:bg-orange-200 transition">
                                                            {{ $dish->category->name }}
                                                        </a>
                                                    @endif

                                                    @php
                                                        $avg = $dish->ratings->avg('rating');
                                                    @endphp

                                                    <p class="font-semibold text-gray-700">
                                                        ⭐
                                                        {{ $avg ? number_format($avg, 1) : 'New' }}
                                                    </p>

                                                </div>

                                                <form action="{{ route('cart.add', $dish->id) }}" method="POST" class="mt-auto">
                                                    @csrf

                                                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-2xl font-semibold py-2 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300">
                                                        Add to Cart
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                    </div>

                </div>

            </div>

        </section>

        

        <div class="mt-12 bg-orange-50 rounded-3xl p-10 flex flex-col md:flex-row items-center justify-between gap-6">

            <div>

                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    Can't decide what to order?
                </h2>

                <p class="text-gray-500">
                    Explore our chef's recommendations and customer favorites.
                </p>

            </div>

            <a href="#"
            class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-2xl font-semibold transition">

                View Specials →

            </a>

        </div>
    </div>
</div>
@endsection