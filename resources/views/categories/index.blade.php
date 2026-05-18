@extends('layouts.app')

@section('content')

<section class="bg-neutral-900 min-h-screen py-20">

    <div class="max-w-7xl mx-auto px-12">
        <h1 class="text-5xl font-bold text-white mb-10">
            Categories
        </h1>
        <p class="text-neutral-400 mb-6 max-w-2xl">
            Discover carefully crafted meals, desserts, and beverages prepared for every taste.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-20">

            @foreach($categories as $category)

                <div class="bg-neutral-800 rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 transition duration-300">
                    <div class="p-6">
                        <div class="text-4xl mb-4">
                            🍽️
                        </div>
                        <h2 class="text-2xl font-bold text-white mb-3">
                            {{ $category->name }}
                        </h2>
                        <p class="text-neutral-400 mb-6">
                            Explore delicious dishes from our {{ strtolower($category->name) }} selection.
                        </p>
                        <a href="{{ route('categories.show', $category->id) }}" class="text-orange-400 font-semibold hover:text-orange-300 transition">
                            Explore →
                        </a>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

</section>

@endsection