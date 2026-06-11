@extends('layouts.app')

@section('content')
@php
    $icons = [
        '1' => '🍕',
        '2' => '🥤',
        '3' => '🍰',
        '4' => '🍳',
        '5' => '🥗',
        '6' => '🍔',
    ];
@endphp

    <section class="grid md:grid-cols-2 gap-12 bg-gray-50 items-center px-14 pt-14 pb-20 mb-10">
        <div class="max-w-7xl mx-auto">
            <p class="text-orange-500 font-semibold uppercase tracking-widest mb-4">
                {{ __('home.welcome_text') }}
            </p>

            <h1 class="text-5xl text-neutral-800 font-bold leading-tight mb-6">
                {{ __('home.hero_title') }}
            </h1>

            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                {{ __('home.hero_description') }}
            </p>

            <div class="flex gap-8">
                <a href="/categories" class="bg-orange-500 hover:bg-orange-600 hover:scale-102 hover:shadow-lg hover:shadow-orange-500/30 text-white px-5 py-4 rounded-2xl font-semibold transition duration-300 mt-4">
                    {{ __('navigation.browse_menu') }}
                </a>
                <a href="/reservations/create" class="border border-orange-600 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-orange-500 hover:text-white px-4 py-4 rounded-2xl font-semibold transition duration-300 mt-4">
                    {{ __('navigation.reserve') }}
                </a>
            </div>
        </div>

        <div>
            <img
                src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5"
                class="rounded-2xl shadow-2xl h-[500px] w-full object-cover"
            >
        </div>
    </section>

    <section class="max-w-7xl mx-auto text-stone-800 pt-18 pb-12">
        <div class="flex justify-between items-center mb-6">
            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] mb-4 font-semibold">
                    {{ __('category.categories') }}
                </p>
                <h2 class="text-4xl text-neutral-800 font-bold leading-tight mb-8">
                    {{ __('category.culinary_selection') }}
                </h2>
            </div>
            <a href="/categories"
               class="text-orange-500 hover:text-orange-600 font-medium">
                {{ __('category.view_all') }} →
            </a>
        </div>
        
        <div class="swiper categorySwiper">
            <div class="swiper-wrapper">

                @foreach($categories as $category )

                    <div class="swiper-slide h-auto px-1 py-3">

                        <a href="/categories/{{ $category->id }}"
                            class="flex flex-col bg-gray-100 text-center rounded-[1rem]
                            shadow-md hover:shadow-2xl
                            hover:scale-[1.03] border border-transparent hover:border-orange-400
                            transition duration-300 px-4 py-8 h-full mb-16">
                            
                            <div class="w-14 h-14 rounded-full bg-orange-300 flex items-center justify-center mb-4 mx-auto">
                                {{ $icons[$category->id] ?? '🍽️' }}
                            </div>

                            <h3 class="text-neutral-800 text-xl font-bold mb-4 min-h-[60px] flex items-center justify-center">
                                {{ $category->translated_name }}
                            </h3>
                            
                            <p class="text-gray-600 font-semibold">
                                {{ trans_choice('dish.dish_count', $category->dishes_count, ['count' => $category->dishes_count]) }}
                            </p>
                        </a>

                    </div>

                @endforeach

            </div>

            <div class="swiper-pagination"></div>

        </div>

    </section>
 
    <section class="max-w-7xl mx-auto py-18 mb-10">

        <div class="flex justify-between items-center mb-12">
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
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-56 object-cover hover:scale-105 transition duration-500">
                            @endif
                
                            
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
                
                        </a>
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
                            {{ Str::limit($dish->translated_description, 75) }}
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

                            <p class="font-semibold text-gray-700">
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

        </div>
    </section>
    
    <section class="bg-gray-50 px-14 pt-14 pb-28">

        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14">
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold">
                    {{ __('location.location') }}
                </p>
                <h2 class="text-5xl text-neutral-800 font-bold mt-4">
                    {{ __('location.location_header') }}
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                    {{ __('location.location_description') }}
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                <div class="space-y-4">

                    <div>
                        <h3 class="text-xl text-neutral-800 font-semibold">📍 {{ __('location.where_to_find') }}</h3>
                        <p class="text-gray-600 mb-4 mt-2">{{ __('location.address') }}</p>
                        <a href="https://www.google.com/maps?q=Ashgabat"
                           target="_blank"
                           class="text-white bg-orange-500 hover:bg-orange-500 hover:shadow-orange-500/30 border border-orange-500 rounded-xl transition duration-300 py-1 px-3">
                            {{ __('location.open_map') }}
                        </a>
                    </div>

                    <div>
                        <h3 class="text-xl text-neutral-800 font-semibold mt-9">🕒 {{ __('location.opening_hours') }}</h3>
                        <p class="text-gray-600 mt-2">{{ __('location.open_hours') }}</p>
                        <p class="text-gray-600">{{ __('location.open_hours_description') }}</p>
                    </div>

                    <div>
                        <h3 class="text-xl text-neutral-800 font-semibold mt-9">📞 {{ __('contact.contact') }}</h3>
                        <div class="flex mb-4">
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

                <div class="lg:sticky top-24 rounded-2xl overflow-hidden h-[400px]">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2191.1350298792936!2d58.37954730480198!3d37.941600536293755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6fff2c4815c659%3A0x834c6009e5b9958c!2z0JrQsNGE0LUgIkdVQkFEQUcgRklUw4dJIiBBxZ9nYWJhdA!5e1!3m2!1sen!2sus!4v1779367071390!5m2!1sen!2sus" 
                        width="600"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

@endsection