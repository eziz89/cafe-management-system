@extends('layouts.app')

@section('content')

<section class="bg-gray-50 py-10">

    <div class="max-w-7xl mx-auto sm:px-0 px-6">

        <div class="sm:mb-6 mb-4">

            <p class="text-orange-400 font-semibold uppercase tracking-widest mb-2">
                {{ __('category.menu_category') }}
            </p>

            <h1 class="sm:text-5xl text-4xl font-bold text-neutral-900 mb-4">
                {{ $category->translated_name }}
            </h1>

            <p class="text-neutral-500 max-w-3xl text-lg">
                {{ __('category.discover_text') }} {{ ($category->translated_name) }} {{ __('category.collection') }}
            </p>

        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

            @foreach($category->dishes as $dish)

                <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300">
                    
                    <div class="relative">
                        <a href="/menu/{{ $dish->id }}" class="overflow-hidden">
                
                            @if($dish->image)
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}"class="w-full h-36 sm:h-48 lg:h-56 object-cover hover:scale-105 transition duration-500">
                            @endif
                
                            <div class="absolute sm:top-1 left-1 -top-1 sm:left-4 z-30  rounded-full shadow-xl flex items-center justify-center transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1">
                                @if($dish->status === 'coming_soon')

                                    <p class="text-yellow-600 bg-yellow-100 border border-yellow-600 rounded-full text-[10px] sm:text-xs font-medium p-2 mt-2">
                                        {{ __('dish.coming_soon') }}
                                    </p>

                                @elseif($dish->status === 'out_of_stock')

                                    <p class="text-red-600 bg-red-100 border border-red-600 rounded-full text-[10px] sm:text-xs font-medium p-2 mt-2">
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

                    <div class="p-3 sm:p-4 lg:p-6 flex flex-col flex-grow">

                        <div class="flex justify-between items-start sm:mb-4 mb-2">

                            <a href="/menu/{{ $dish->id }}">
                                <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 hover:text-orange-500 transition line-clamp-2 leading-tight">
                                    {{ $dish->translated_name }}
                                </h3>
                            </a>

                            <span class="text-orange-500 font-bold text-base hidden sm:block sm:text-lg lg:text-xl whitespace-nowrap shrink-0">
                                {{ $dish->price }} TMT
                            </span>
                        </div>

                        <p class="sm:line-clamp-3 line-clamp-2 text-gray-500 leading-relaxed sm:mb-5 mb-2">
                            {{ Str::limit($dish->translated_description, 80) }}
                        </p>

                        <div class="flex justify-between items-center sm:mb-4 mb-3">

                            <span class="text-orange-500 font-bold text-base sm:hidden sm:text-lg">
                                {{ number_format($dish->price, 2) }} TMT
                            </span>

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

                                <button class="add-to-cart-btn flex justify-center items-center gap-2 w-full bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-semibold sm:py-2 py-1 text-sm lg:text-base hover:shadow-lg hover:shadow-orange-500/30 transition duration-300" data-id="{{ $dish->id }}">
                                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                                    {{ __('cart.add_to_cart') }}
                                </button>

                            @elseif($dish->status === 'coming_soon')

                                <button
                                    disabled
                                    class="w-full sm:py-2 py-1 text-sm lg:text-base rounded-xl bg-yellow-100 text-yellow-700 font-semibold cursor-not-allowed">
                                    {{ __('dish.coming_soon') }}
                                </button>

                            @else

                                <button
                                    disabled
                                    class="w-full sm:py-2 py-1 text-sm lg:text-base rounded-xl bg-red-100 text-red-700 font-semibold cursor-not-allowed">
                                    {{ __('dish.out_of_stock') }}
                                </button>

                            @endif
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>

</section>

@endsection