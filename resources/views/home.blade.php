
@extends('layouts.app')

@section('content')

<section class="grid md:grid-cols-2 gap-12 bg-gray-50 items-start lg:items-center px-4 sm:px-4 lg:px-6 pt-10 sm:pt-14 pb-12 sm:pb-18">

    <div>
        <p class="text-orange-500 font-semibold uppercase tracking-widest mb-4">
            {{ __('home.welcome_text') }}
        </p>
        <h1 class="text-4xl sm:text-5xl text-neutral-800 font-bold leading-tight mb-6">
            {{ __('home.hero_title') }}
        </h1>
        <p class="text-gray-600 text-base sm:text-lg mb-6 leading-relaxed">
            {{ __('home.hero_description') }}
        </p>
        <div class="flex flex-row gap-5 sm:items-center">
            <a href="/categories" class="gap-4 w-full sm:w-auto bg-orange-500 hover:bg-orange-600 hover:scale-102 hover:shadow-lg hover:shadow-orange-500/30 text-white px-5 py-4 rounded-2xl font-semibold transition duration-300 lg:mt-4">
                {{ __('navigation.browse_menu') }}
            </a>
            <a href="/reservations/create" class="gap-4 w-full sm:w-auto border border-orange-600 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-orange-500 hover:text-white px-4 py-4 rounded-2xl font-semibold transition duration-300 lg:mt-4">
                {{ __('navigation.reserve') }}
            </a>
        </div>
    </div>

    <div>
        <img
            src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5"
            class="rounded-2xl shadow-xl h-[320px] md:h-[500px] w-full object-cover"
        >
    </div>
    
</section>

<section class="text-stone-800 px-6 pt-12 sm:pt-18">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-6">
        <div>
            <p class="text-orange-500 uppercase tracking-[0.3em] mb-4 font-semibold">
                {{ __('category.categories') }}
            </p>
            <h2 class="text-3xl sm:text-4xl text-neutral-800 font-bold leading-tight mb-">
                {{ __('category.culinary_selection') }}
            </h2>
        </div>
        <a href="/categories"
           class="text-orange-500 hover:text-orange-600 font-medium">
            {{ __('category.view_all') }} →
        </a>
    </div>
    
    <div class="swiper categorySwiper">

        <div class="swiper-wrapper mb-14">

            @foreach($categories as $category )

                <div class="swiper-slide h-auto px-1 sm:px-2 py-3">

                    <div class="group bg-white rounded-3xl relative overflow-hidden shadow-lg hover:-translate-y-2 border border-orange-200 hover:border-orange-500/40 transition duration-300">

                        <a href="{{ route('categories.show', $category->id) }}">

                            @if($category->image)

                                <div class="mb-5 overflow-hidden">

                                    <img
                                        src="{{ asset('storage/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="w-full h-36 object-cover transition duration-500 group-hover:scale-105">

                                </div>

                            @endif

                            <div class="absolute top-1 left-4 z-3 pt-2">

                                <span class="bg-orange-100 text-orange-500 px-3 py-1 rounded-full text-sm">
                                    {{ trans_choice('dish.dish_count', $category->dishes_count, ['count' => $category->dishes_count]) }}
                                </span>

                            </div>

                            <h2 class="text-2xl font-bold text-neutral-800 hover:text-orange-500 transition duration-300 my-3 px-6">
                                {{ $category->translated_name }}
                            </h2>

                            @if($category->description)

                                <p class="text-gray-500 leading-relaxed my-3 line-clamp-2 px-6">

                                    {{ $category->description }}

                                </p>

                            @endif

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<section class="px-6 sm:py-18 py-14">

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 mb-8 sm:mb-12">
        <div>
            <p class="text-orange-500 uppercase tracking-widest font-semibold">
                {{ __('dish.featured_dishes') }}
            </p>
            <h2 class="text-4xl font-bold text-gray-800 mt-2">
                {{ __('dish.customer_favorites') }}
            </h2>
        </div>
        <a href="/menu" class="text-orange-500 hover:text-orange-600 font-medium">
            {{ __('dish.view_menu') }} →
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($featuredDishes as $dish)
            
            <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300 flex flex-col">
                <div class="relative">
                    <a href="/menu/{{ $dish->id }}" class="overflow-hidden">
            
                        @if($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-52 sm:h-56 object-cover hover:scale-105 transition duration-500">
                        @endif
                        
                        <div class="absolute top-1 left-4 z-30  rounded-full shadow-xl flex items-center justify-center transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1">
                            @if($dish->status === 'coming_soon')
                                <p class="text-yellow-600 bg-yellow-100 border border-yellow-600 rounded-full text-sm font-medium p-2 mt-2">
                                    {{ __('dish.coming_soon') }}
                                </p>
                            @elseif($dish->status === 'out_of_stock')
                                <p class="text-red-600 bg-red-100 border border-red-600 rounded-full text-sm font-medium p-2 mt-2">
                                    {{ __('dish.out_of_stock') }}
                                </p>
                            @endif
                        </div>
                        
                        @auth

                            @php
                                $isFavorited = auth()->user()->favorites->contains($dish->id);
                            @endphp

                            <button
                                class="favorite-btn absolute sm:top-1 sm:right-4 top-1 right-2 z-10
                                    w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12
                                    rounded-full shadow-xl flex items-center justify-center
                                    transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1
                                    {{ $isFavorited ? 'bg-red-500' : 'bg-white/90' }}"
                                data-id="{{ $dish->id }}">

                                <i data-lucide="heart"
                                   class="w-4 h-4 sm:w-6 sm:h-6 {{ $isFavorited ? 'text-white fill-current' : 'text-gray-600' }}">
                                </i>

                            </button>
            
                        @endauth
            
                    </a>
                </div>

                <div class="sm:p-6 p-4 flex flex-col flex-grow">

                    <div class="flex flex-row justify-between items-start gap-2 sm:gap-4 mb-3">

                        <a href="/menu/{{ $dish->id }}">
                            <h3 class="text-2xl font-bold text-gray-800 hover:text-orange-500 transition">
                                {{ $dish->translated_name }}
                            </h3>
                        </a>

                        <span class="text-orange-500 font-bold text-xl whitespace-nowrap">
                            {{ number_format($dish->price, 2) }} TMT
                        </span>

                    </div>

                    <p class="text-gray-500 leading-relaxed sm:mb-5 mb-4">
                        {{ Str::limit($dish->translated_description, 75) }}
                    </p>

                    <div class="flex justify-between items-center sm:mb-6 mb-4">

                        @if($dish->category)
                        
                            <a href="{{ route('categories.show', $dish->category->id) }}" class="inline-flex items-center bg-orange-100 text-orange-600 text-sm font-medium rounded-full px-3 py-1 hover:bg-orange-200 transition">
                                {{ $dish->category->translated_name }}
                            </a>

                        @endif

                        @php

                            $avg = $dish->ratings->avg('rating');

                        @endphp

                        <p class="font-semibold text-gray-700 flex items-center gap-1">
                            <i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                            {{ $avg ? number_format($avg, 1) : __('dish.new') }}
                        </p>

                    </div>

                    <div class="mt-auto">
                        @if($dish->status === 'available')

                            <button class="add-to-cart-btn flex justify-center items-center gap-2 w-full bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-semibold py-2 text-sm lg:text-base hover:shadow-lg hover:shadow-orange-500/30 transition duration-300" data-id="{{ $dish->id }}">
                                <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                {{ __('cart.add_to_cart') }}
                            </button>

                        @elseif($dish->status === 'coming_soon')

                            <button
                                disabled
                                class="w-full py-2 text-sm lg:text-base rounded-xl bg-yellow-100 text-yellow-700 font-semibold cursor-not-allowed">
                                {{ __('dish.coming_soon') }}
                            </button>

                        @else

                            <button
                                disabled
                                class="w-full py-2 text-sm lg:text-base rounded-xl bg-red-100 text-red-700 font-semibold cursor-not-allowed">
                                {{ __('dish.out_of_stock') }}
                            </button>

                        @endif
                    </div>

                </div>
            </div>

        @endforeach

    </div>

</section>

<section class="bg-gray-50 px-6 pt-10 sm:pt-14 pb-8 sm:pb-10">

    <div class="max-w-7xl mx-auto">

        <div class="text-center sm:mb-12 mb-6">

            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold">
                {{ __('location.location') }}
            </p>

            <h2 class="text-3xl sm:text-5xl text-neutral-800 font-bold mt-4">
                {{ __('location.location_header') }}
            </h2>

            <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                {{ __('location.location_description') }}
            </p>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-4">
                <div>
                    <h3 class="flex items-center gap-2 text-xl text-neutral-800 font-semibold">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    {{ __('location.where_to_find') }}</h3>
                    <p class="text-gray-600 mb-4 mt-2">{{ __('location.address') }}</p>
                    <a href="https://www.google.com/maps?q=Ashgabat"
                       target="_blank"
                       class="text-white bg-orange-500 hover:bg-orange-500 hover:shadow-orange-500/30 border border-orange-500 rounded-xl transition duration-300 py-1 px-3">
                        {{ __('location.open_map') }}
                    </a>

                </div>

                <div>
                    <h3 class="flex items-center gap-2 text-xl text-neutral-800 font-semibold mt-9">
                    <i data-lucide="clock-3" class="w-5 h-5"></i>
                    {{ __('location.opening_hours') }}</h3>
                    <p class="text-gray-600 mt-2">{{ __('location.open_hours') }}</p>
                    <p class="text-gray-600">{{ __('location.open_hours_description') }}</p>
                </div>

                <div>

                    <h3 class="flex items-center gap-2 text-xl text-neutral-800 font-semibold mt-9">
                        <i data-lucide="phone" class="w-5 h-5"></i>
                        {{ __('contact.contact') }}</h3>
                    
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-5 mb-4">

                        <p class="text-gray-400 pr-5">+993 XX XXX XXX</p>
                        <p class="text-gray-400">+993 XX XXX XXX</p>

                    </div>

                    <a href="tel:+993XXXXXXXX" class="text-white bg-orange-500 rounded-xl hover:bg-orange-500 hover:shadow-orange-500/30 border border-orange-500 transition duration-300 py-1 px-3">
                        {{ __('contact.call_us') }}
                    </a>

                    <p class="text-gray-400 mt-4 mb-2">canteen@example.com</p>

                    <a href="mailto:canteen@example.com"
                       class="text-white bg-orange-500 rounded-xl hover:bg-orange-500 hover:shadow-orange-500/30 border border-orange-500 transition duration-300 py-1 px-3">
                        {{ __('contact.send_email') }}
                    </a>

                </div>

            </div>
            
            <div class="lg:sticky top-24 rounded-2xl overflow-hidden h-[320px] sm:h-[400px]">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2191.1350298792936!2d58.37954730480198!3d37.941600536293755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6fff2c4815c659%3A0x834c6009e5b9958c!2z0JrQsNGE0LUgIkdVQkFEQUcgRklUw4dJIiBBxZ9nYWJhdA!5e1!3m2!1sen!2sus!4v1779367071390!5m2!1sen!2sus" 
                    class="w-full h-full border-0"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

@endsection