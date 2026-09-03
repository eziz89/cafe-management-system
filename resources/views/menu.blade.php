@extends('layouts.app')

@section('content')

@php
    $filters = request()->only(['search', 'category', 'sort']);
@endphp

<div class="bg-gray-50">

    <div class="sm:pb-12 pb-8">
        
        <section class="relative">

            <img src="{{ asset('images/menu-header.jpg') }}" alt="Our Menu" class="w-full h-[320px] md:h-[380px] object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/10 flex items-center pt-28">

                <div class="px-6 md:px-12 text-white">

                    <p class="uppercase tracking-[0.3em] text-orange-300 font-semibold">
                        {{ __('menu.menu') }}
                    </p>

                    <h1 class="text-4xl md:text-5xl font-bold mt-4">
                        {{ __('menu.menu_title') }}
                    </h1>

                    <p class="mt-4 sm:text-lg max-w-xl text-gray-200 mb-12">
                        {{ __('menu.menu_description') }}
                    </p>

                </div>

            </div>

        </section>

        <section id="menu-container">

            <div class="px-4">

                <div class="grid lg:grid-cols-4 gap-4">
                    
                    {{-- SIDEBAR --}}
                    <div class="hidden lg:block lg:col-span-1 mt-6">

                        <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-24 h-fit">

                            <h2 class="text-2xl font-bold mb-6">
                                {{ __('category.categories') }}
                            </h2>

                            <div class="space-y-3">

                                <div class="max-h-96 overflow-y-auto pr-5 custom-scrollbar">

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

                    </div>

                    {{-- DISHES --}}
                    <div class="lg:col-span-3">

                        <div class="sticky bg-white rounded-b-2xl shadow-lg lg:top-20 top-4 z-40 bg-gray-50 px-4 pt-4 mb-4">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 gap-4">

                                <div id="menu-info-container">
                                    @include('dishes.info')
                                </div>

                                <form action="{{ route('menu.index') }}" method="GET">

                                    <div class="flex flex-row items-stretch sm:items-center gap-3">

                                        <div class="relative w-full text-gray-400 focus-within:text-orange-500">
                                           
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-2 pointer-events-none">
                                                <i data-lucide="search" class="w-5 h-5"></i>
                                            </div>

                                            <input
                                                type="text" name="search"
                                                value="{{ request('search') }}"
                                                placeholder="{{ __('menu.search_dishes') }}"
                                                class="w-full bg-gray-100 pl-8 pr-4 sm:py-3 py-1 border border-orange-300 sm:rounded-2xl rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-300">
                                        </div>

                                        @foreach(request()->except(['search', 'sort']) as $key => $value)
                                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                        @endforeach

                                        <select
                                            id="sortSelect"
                                            name="sort"
                                            class="w-full sm:w-auto bg-gray-100 sm:rounded-2xl rounded-xl px-2 sm:py-3 py-1 border border-orange-300 focus:outline-none focus:ring-2 focus:ring-orange-300">

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

                                        <a href="{{ route('menu.index') }}" id="resetBtn" class="w-full sm:w-auto bg-gray-100 sm:rounded-2xl rounded-xl px-4 sm:py-3 py-1 border border-orange-300 transition">
                                            <div class="flex items-center gap-2">
                                                <i data-lucide="circle-x" class="w-5 h-5"></i>
                                                {{ __('menu.reset') }}
                                            </div>
                                        </a>

                                    </div>

                                </form>

                            </div>

                            <div class="grid lg:grid-cols-4 gap-10">

                                {{-- MOBILE CATEGORY FILTER --}}
                                <div class="lg:hidden bg-gray-100 rounded-2xl px-4 border border-orange-300 sm:rounded-2xl rounded-xl mb-4 w-full min-w-0">

                                    <div class="w-full overflow-x-auto">

                                        <div class="flex gap-3 w-max pr-6">

                                            <a href="#"
                                               class="category-filter flex items-center justify-between px-4 py-1 rounded-2xl transition hover:bg-orange-50 hover:text-orange-500"
                                               data-category="">
                                                {{ __('menu.all_dishes') }}
                                            </a>

                                            @foreach($categories as $category)

                                                <a href="#"
                                                   class="category-filter flex items-center justify-between px-4 py-1 rounded-2xl transition hover:bg-orange-50 hover:text-orange-500"
                                                   data-category="{{ $category->id }}">

                                                    {{ $category->translated_name }}

                                                </a>

                                            @endforeach

                                        </div>

                                    </div>

                                </div>

                            </div>

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
                                        {{ __('menu.loading_dishes') }}
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
        
    </div>
</div>

@endsection