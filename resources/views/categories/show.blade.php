@extends('layouts.app')

@section('content')
<section class="bg-neutral-950 min-h-screen py-20">
    <div class="max-w-7xl mx-auto">
        <div class="mb-16">
            <p class="text-orange-400 font-semibold uppercase tracking-widest mb-4">
                {{ __('category.menu_category') }}
            </p>
            <h1 class="text-5xl font-bold text-white mb-6">
                {{ $category->translated_name }}
            </h1>
            <p class="text-neutral-400 max-w-3xl text-lg">
                {{ __('category.discover_text') }} {{ ($category->translated_name) }} {{ __('category.collection') }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($category->dishes as $dish)
                <div class="bg-neutral-900/80 backdrop-blur rounded-3xl overflow-hidden shadow-2xl border border-neutral-800 hover:border-orange-500/40 hover:-translate-y-2 transition duration-300">
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

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">

                            <a href="/menu/{{ $dish->id }}">
                                <h2 class="text-2xl font-bold text-white hover:text-orange-500 transition">
                                    {{ $dish->translated_name }}
                                </h2>
                            </a>

                            <span class="text-orange-400 font-bold text-lg">
                                ${{ $dish->price }}
                            </span>
                        </div>

                        <p class="text-neutral-400 mb-6 leading-relaxed">
                            {{ Str::limit($dish->translated_description, 80) }}
                        </p>

                        @php
                            $avg = $dish->ratings->avg('rating');
                        @endphp

                        <p class="text-white mb-4">⭐ {{ number_format($avg, 1) }}/5</p>

                        <button class="add-to-cart-btn w-full bg-orange-500 hover:bg-orange-600 text-white rounded-2xl font-semibold py-2 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300"
                            data-id="{{ $dish->id }}">
                            {{ __('cart.add_to_cart') }}
                        </button>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>

</section>

@endsection