@extends('layouts.app')

@section('content')

@php
    $icons = [
        'Pastries & Baked Goods' => '🍕',
        'Drinks' => '🥤',
        'Light Bites & Savory Snacks' => '🍰',
        'Breakfast & Brunch' => '🍳',
        'Salads & Soups' => '🥗',
        'Sandwiches, Paninis & Wraps' => '🍔',
    ];

    $descriptions = [
        'Pastries & Baked Goods' => 'Freshly baked pizzas with premium ingredients.',
        'Drinks' => 'Refreshing beverages for every taste.',
        'Light Bites & Savory Snacks' => 'Sweet treats crafted by our chefs.',
        'Breakfast & Brunch' => 'Start your day with delicious meals.',
        'Salads & Soups' => 'Healthy and flavorful options prepared daily.',
        'Sandwiches, Paninis & Wraps' => 'Juicy burgers made from quality ingredients.',
    ];
@endphp

<section class="bg-neutral-900 min-h-screen pt-20 pb-6 mb-24 mx-16">

    <div class="max-w-7xl mx-auto px-12">
        <h1 class="text-5xl font-bold text-white mb-10">
            {{ __('category.categories') }}
        </h1>
        <p class="text-neutral-400 mb-6 max-w-2xl">
            {{ __('category.category_description') }}
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 pb-20">

            @foreach($categories as $category)

                <div class="bg-neutral-800 rounded-3xl overflow-hidden shadow-lg hover:-translate-y-2 border hover:border-orange-500/40 transition duration-300 p-6">
                    <div class="flex justify-between items-start mb-">
                        <div>
                            <div class="text-4xl text-center mb-3">
                                {{ $icons[$category->name] ?? '🍽️' }}
                            </div>
                            <h2 class="text-2xl font-bold text-white mb-3">
                                {{ $category->translated_name }}
                            </h2>
                            <p class="text-neutral-400 my-6">
                                {{ $descriptions[$category->name] ?? 'Explore our delicious selection.' }}
                            </p>
                            <div class="flex justify-between">
                                <span class="bg-orange-500/10 text-orange-400 px-3 py-1 rounded-full text-sm">
                                    {{ $category->dishes_count }}
                                    {{ Str::plural('dish', $category->dishes_count) }}
                                </span>
                                <a href="{{ route('categories.show', $category->id) }}" class="text-orange-400 font-semibold hover:text-orange-300 transition">
                                    {{ __('category.explore') }} →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>

</section>

@endsection