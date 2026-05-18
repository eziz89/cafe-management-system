@extends('layouts.app')

@section('content')

    <section class="grid md:grid-cols-2 gap-12 items-center py-20">
        <div>
            <p class="text-orange-500 font-semibold uppercase tracking-widest mb-4">
                Welcome to Our Café
            </p>

            <h1 class="text-5xl font-bold leading-tight mb-6">
                Delicious Food,
                Comfortable Atmosphere,
                Memorable Experience.
            </h1>

            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                Discover our carefully crafted dishes, reserve your table effortlessly,
                and enjoy a modern café experience designed for comfort and flavor.
            </p>

            <div class="flex gap-4">
                <a href="/categories"
                   class="bg-black text-white px-8 py-4 rounded-2xl hover:scale-105 transition">
                    Browse Menu
                </a>
                <a href="/reservations/create"
                   class="border border-black px-8 py-4 rounded-2xl hover:bg-black hover:text-white transition">
                    Reserve Table
                </a>
            </div>
        </div>

        <div>
            <img
                src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5"
                class="rounded-3xl shadow-2xl h-[500px] w-full object-cover"
            >
        </div>
    </section>

    <section class="py-16">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-4xl font-bold">
                Categories
            </h2>
            <a href="/categories"
               class="text-orange-500 font-semibold">
                View All
            </a>
        </div>

        <section class="py-18 bg-white rounded-[2rem] shadow-2xl text-stone-800 px-15">
            <div class="flex justify-between items-end mb-16">
                <div>
                    <p class="text-orange-500 uppercase tracking-[0.3em] mb-4 font-semibold">
                        Categories
                    </p>
                    <h2 class="text-4xl text-black font-bold leading-tight">
                        Explore Our Culinary Selection
                    </h2>
                </div>

                <a href="/categories"
                   class="text-lg font-semibold text-orange-500">
                    View All →
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                @foreach($categories as $category)

                    <a href="/categories/{{ $category->id }}"
                       class="bg-neutral-800 rounded-[2rem] p-10
                              shadow-md hover:shadow-2xl
                              hover:-translate-y-2
                              transition duration-300">

                        <div class="w-16 h-16 rounded-2xl
                                    bg-white flex
                                    items-center justify-center mb-8">
                            <span class="text-3xl">
                                🍴
                            </span>
                        </div>
                        <h3 class="text-white text-3xl font-bold mb-4">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-400 leading-relaxed">
                            Carefully curated dishes designed
                            for flavor and comfort.
                        </p>
                    </a>

                @endforeach
            </div>
        </section>
    </section>

@endsection