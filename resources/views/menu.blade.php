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

        <section class="py-20 bg-gray-50">

            <div class="max-w-7xl mx-auto">

                <div class="grid lg:grid-cols-4 gap-10">

                    {{-- SIDEBAR --}}
                    <div class="lg:col-span-1">

                        <div class="bg-white rounded-3xl shadow-lg p-6 sticky top-24 h-fit">

                            <h2 class="text-2xl font-bold mb-6">
                                {{ __('category.categories') }}
                            </h2>

                            <div class="space-y-3">

                                <a href="{{ route('menu.index', ['search' => request('search'), 'sort' => request('sort')]) }}" class="flex items-center justify-between px-4 py-3 rounded-2xl transition
                                    {{ !request('category') ? 'bg-orange-100 text-orange-600 font-semibold' : ' hover:bg-orange-50 hover:text-orange-500' }}">

                                    <span>{{ __('menu.all_dishes') }}</span>

                                    <span>{{ $totalDishes }}</span>

                                </a>

                                @foreach($categories as $category)

                                    <a href="{{ route('menu.index', ['category' => $category->id, 'search' => request('search'), 'sort' => request('sort')]) }}"
                                    class="flex items-center justify-between px-4 py-3 rounded-2xl transition
                                        {{ request('category') == $category->id ? 'bg-orange-100 text-orange-600 font-semibold' : ' hover:bg-orange-50 hover:text-orange-500' }}">

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

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10 gap-4">

                            <div>

                                <h2 class="text-4xl font-bold text-gray-900 mb-2">
                                    {{ __('menu.all_dishes') }}
                                </h2>

                                @if(request('category'))

                                    @php
                                        $selectedCategory = $categories->firstWhere('id', request('category'));
                                    @endphp

                                    <p class="text-orange-500 font-medium mt-2">
                                        {{ __('category.category') }}: {{ $selectedCategory?->translated_name }}
                                    </p>

                                @endif

                                <p class="text-gray-500">
                                    {{ __('menu.showing') }}
                                    {{ $dishes->count() }}
                                    {{ __('menu.delicious_items') }}
                                </p>

                            </div>

                            <form action="{{ route('menu.index') }}" method="GET">

                                <div class="flex gap-3">
                                    
                                    <a href="{{ route('menu.index') }}"
                                        class="flex items-center justify-center gap-2 px-4 py-3 rounded-2xl bg-white shadow-sm hover:shadow-md transition">
                                        <i data-lucide="x-circle" class="w-4 h-4"></i>
                                        Reset
                                    </a>

                                    @foreach(request()->except(['search', 'sort']) as $key => $value)
                                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endforeach

                                    <input
                                        type="text" name="search"
                                        value="{{ request('search') }}"
                                        placeholder="Search dishes..."
                                        class="px-4 py-3 border rounded-2xl w-full focus:ring-2 focus:ring-orange-300">

                                    <select 
                                        name="sort"
                                        onchange="this.form.submit()"
                                        class="bg-white border border-gray-200 rounded-2xl px-4 py-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-300">

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

                                    <button type="submit" class="bg-orange-500 text-white px-6 rounded-2xl hover:bg-orange-600 transition">
                                        Search
                                    </button>

                                </div>
                            </form>

                        </div>

                        <div class="flex flex-wrap gap-3 mb-6">

                            @if(request('search'))
                                <a href="{{ route('menu.index', request()->except('search')) }}"
                                    class="flex items-center gap-2 bg-orange-100 text-orange-600 px-4 py-2 rounded-full hover:bg-orange-200 transition">

                                    Search: {{ request('search') }}

                                    <span class="font-bold">✕</span>
                                </a>
                            @endif

                            @if(request('category'))
                                @php
                                    $selectedCategory = $categories->firstWhere('id', request('category'));
                                @endphp

                                <a href="{{ route('menu.index', request()->except('category')) }}"
                                    class="flex items-center gap-2 bg-blue-100 text-blue-600 px-4 py-2 rounded-full hover:bg-blue-200 transition">

                                    {{ $selectedCategory?->translated_name }}

                                    <span class="font-bold">✕</span>
                                </a>
                            @endif

                            @if(request('sort') && request('sort') !== 'newest')
                                @php
                                    $sortLabels = [
                                        'price_low' => 'Price: Low → High',
                                        'price_high' => 'Price: High → Low',
                                        'top_rated' => 'Top Rated'    
                                    ];
                                @endphp
                                
                                <a href="{{ route('menu.index', request()->except('sort')) }}"
                                    class="flex items-center gap-2 bg-green-100 text-green-600 px-4 py-2 rounded-full hover:bg-green-200 transition">
                                
                                    {{ $sortLabels[request('sort')] ?? 'Sort' }}
                                
                                    <span class="font-bold">✕</span>
                                </a>
                            @endif
                                
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            
                            @if($dishes->isEmpty())

                                <div class="col-span-full text-center py-16">
                                    <h3 class="text-2xl font-bold text-gray-700 mb-2">
                                        No dishes found
                                    </h3>

                                    <p class="text-gray-700">
                                        Try another search term.
                                    </p>
                                </div>

                            @else

                                @foreach($dishes as $dish)

                                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300 flex flex-col">
                                        <div class="relative overflow-hidden rounded-t-3xl">
                                            <a href="/menu/{{ $dish->id }}">
                                    
                                                @if($dish->image)
                                                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-56 object-cover hover:scale-105 transition duration-500">
                                                @endif
                                    
                                            </a>

                                            @auth
                                
                                                @php
                                                    $isFavorited = auth()->user()->favorites->contains($dish->id);
                                                @endphp
                                            
                                                <button class="favorite-btn absolute top-4 right-4 z-30 w-12 h-12 rounded-full shadow-xl flex items-center justify-center transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1
                                                    {{ $isFavorited ? 'bg-red-500 text-white' : 'bg-white/90 text-gray-600' }}"
                                                    data-id="{{ $dish->id }}">
                                                    🤍
                                                </button>
                                
                                            @endauth
                                        </div>

                                        <div class="p-6 flex flex-col flex-grow">

                                            <div class="flex justify-between items-start gap-4 mb-3">

                                                <a href="/menu/{{ $dish->id }}">
                                                    <h3 class="text-2xl font-bold text-gray-800 hover:text-orange-500 transition">
                                                        {{ $dish->translated_name }}
                                                    </h3>
                                                </a>

                                                <span class="text-orange-500 font-bold text-xl whitespace-nowrap">
                                                    ${{ number_format($dish->price, 2) }}
                                                </span>
                                            </div>

                                            <p class="text-gray-500 leading-relaxed mb-5">
                                                {{ Str::limit($dish->translated_description, 50) }}
                                            </p>

                                            <div class="flex justify-between items-center mb-6">

                                                @if($dish->category)
                                                    <a href="{{ route('categories.show', $dish->category->id) }}" class="inline-flex items-center bg-orange-100 text-orange-700 text-sm font-medium rounded-full px-3 py-1 hover:bg-orange-200 transition">
                                                        {{ $dish->category->translated_name }}
                                                    </a>
                                                @endif

                                                @php
                                                    $avg = $dish->ratings->avg('rating');
                                                @endphp

                                                <p class="font-semibold text-gray-700 text-end ">
                                                    ⭐
                                                    {{ $avg ? number_format($avg, 1) : __('dish.new') }}
                                                </p>
                                            </div>
                                            
                                            <form action="{{ route('cart.add', $dish->id) }}" method="POST" class="mt-auto">
                                                @csrf

                                                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white rounded-2xl font-semibold py-2 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300">
                                                    {{ __('cart.add_to_cart') }}
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                        <div class="mt-10">
                            {{ $dishes->appends(request()->query())->links() }}
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