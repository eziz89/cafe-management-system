@extends('layouts.app')

@section('content')

@php
    $filters = request()->only(['search', 'category', 'sort']);
@endphp

<div class="bg-gray-50">
    <div class="pb-24">
        <section class="relative">

            <img src="{{ asset('images/menu-header.jpg') }}" alt="Our Menu" class="w-full h-92 object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/10 flex items-center pt-28">

                <div class="px-12 text-white">

                    <p class="uppercase tracking-[0.3em] text-orange-300 font-semibold">
                        {{ __('menu.menu') }}
                    </p>

                    <h1 class="text-5xl font-bold mt-4">
                        {{ __('menu.menu_title') }}
                    </h1>

                    <p class="mt-4 text-lg max-w-xl text-gray-200">
                        {{ __('menu.menu_description') }}
                    </p>

                </div>

            </div>

        </section>

        <section class="py-20 bg-gray-50" id="menu-container">

            <div class="max-w-7xl mx-auto">

                <div class="grid lg:grid-cols-4 gap-10">

                    {{-- SIDEBAR --}}
                    <div class="lg:col-span-1">

                        <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-24 h-fit">

                            <h2 class="text-2xl font-bold mb-6">
                                {{ __('category.categories') }}
                            </h2>

                            <div class="space-y-3">

                                <a href="{{ route('menu.index') }}"
                                    class="category-filter flex items-center justify-between px-4 py-3 rounded-2xl transition hover:bg-orange-50 hover:text-orange-500"
                                    data-category="">

                                    <span>{{ __('menu.all_dishes') }}</span>

                                    <span>{{ $totalDishes }}</span>

                                </a>

                                @foreach($categories as $category)

                                    <a href="{{ route('menu.index') }}"
                                    class="category-filter flex items-center justify-between px-4 py-3 rounded-2xl transition hover:bg-orange-50 hover:text-orange-500"
                                    data-category="{{ $category->id }}">

                                        <span>{{ $category->translated_name }}</span>

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

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
                                
                            <div id="menu-info-container">
                                @include('dishes.info')
                            </div>

                            <form action="{{ route('menu.index') }}" method="GET">

                                <div class="flex items-center gap-3">

                                    <input
                                        type="text" name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search dishes..."
                                        class="px-4 py-3 border rounded-2xl focus:ring-2 focus:ring-orange-300">

                                    @foreach(request()->except(['search', 'sort']) as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach
                                    
                                    <select
                                        id="sortSelect"
                                        name="sort"
                                        class="bg-white border border-gray-200 rounded-2xl px-2 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-300">

                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                                            {{ __('menu.sort_newest') }}
                                        </option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                            {{ __('menu.sort_price_low_to_high') }}
                                        </option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                            {{ __('menu.sort_price_high_to_low') }}
                                        </option>
                                        <option value="top_rated" {{ request('sort') == 'top_rated' ? 'selected' : '' }}>
                                            {{ __('menu.sort_top_rated') }}
                                        </option>

                                    </select>

                                    <a href="{{ route('menu.index') }}" id="resetBtn" class="bg-white border border-gray-200 rounded-2xl w-full shadow-sm px-4 py-3 transition">
                                        <div class="flex items-center gap-2">
                                            <i data-lucide="circle-x" class="w-5 h-5"></i>
                                            Reset
                                        </div>
                                    </a>

                                </div>
                            </form>

                        </div>

                        <div id="active-filters-container">
                            @include('dishes.filters')
                        </div>

                        <div id="dishes-wrapper" class="relative">

                            <div id="menu-loading" class="hidden absolute inset-0 bg-white/70 backdrop-blur-sm z-20 flex items-center justify-center">

                                <div class="flex flex-col items-center">

                                    <div
                                        class="w-10 h-10 border-4 border-orange-500 border-t-transparent rounded-full animate-spin">
                                    </div>

                                    <p class="mt-3 text-orange-600 font-semibold">
                                        Loading dishes...
                                    </p>

                                </div>

                            </div>

                            <div id="dishes-container">
                                @include('dishes.grid')
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div class="mt-6 bg-orange-50 rounded-3xl p-10 flex flex-col md:flex-row items-center justify-between gap-6">

            <div>

                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ __('menu.chef_recommendation_title') }}
                </h2>

                <p class="text-gray-500">
                    {{ __('menu.chef_recommendation_description') }}
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