@extends('layouts.app')

@section('content')

<div class="bg-gray-50 pt-12 pb-12">

    <div class="max-w-7xl mx-auto sm:px-0 px-6">

        @if($dishes->isEmpty())
            
            <div class="text-center">
                    <i data-lucide="heart-crack" class="w-16 h-16 mx-auto text-red-400"></i>
                <h2 class="text-2xl font-bold mb-2">No favorites yet</h2>
                <p class="text-gray-500 mb-6">
                    Start exploring dishes and save your favorites.
                </p>

                <a href="/menu"
                   class="bg-orange-500 text-white px-6 py-3 rounded-xl">
                    Browse Menu
                </a>
            </div>

        @else

            <h1 class="text-4xl font-bold mb-6">
                My Favorites
            </h1>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                @foreach($dishes as $dish)
    
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300 flex flex-col">
                        
                        <div class="relative overflow-hidden rounded-t-3xl">

                            <a href="/menu/{{ $dish->id }}" class="overflow-hidden">

                                @if($dish->image)
                                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-36 sm:h-48 lg:h-56 object-cover hover:scale-105 transition duration-500">
                                @endif

                            </a>

                            <div class="absolute sm:top-1 left-1 -top-1 sm:left-4 z-10 rounded-full shadow-xl flex items-center justify-center transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1">
                                @if($dish->status === 'coming_soon')

                                    <p class="text-yellow-600 bg-yellow-100 border border-yellow-600 rounded-full text-[10px] sm:text-xs font-medium p-2 mt-2">
                                        Coming Soon
                                    </p>

                                @elseif($dish->status === 'out_of_stock')

                                    <p class="text-red-600 bg-red-100 border border-red-600 rounded-full text-[10px] sm:text-xs font-medium p-2 mt-2">
                                        Out of Stock
                                    </p>

                                @endif
                            </div>

                        </div>

                        <div class="p-3 sm:p-5 lg:p-6 flex flex-col flex-grow">
    
                            <div class="flex justify-between items-start gap-2 mb-3">

                                <a href="/menu/{{ $dish->id }}" class="flex-1 min-w-0">
        
                                    <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-800 hover:text-orange-500 transition line-clamp-2 leading-tight">
                                        {{ $dish->translated_name }}
                                    </h3>
        
                                </a>
        
                                <span class="text-orange-500 font-bold text-base hidden sm:block sm:text-lg lg:text-xl whitespace-nowrap shrink-0">
                                    ${{ number_format($dish->price, 2) }}
                                </span>
    
                            </div>
    
                            <p class="hidden sm:block line-clamp-3 text-gray-500 leading-relaxed mb-5">
                                {{ Str::limit($dish->translated_description, 50) }}
                            </p>
    
                            <div class="flex justify-between items-center mb-4">
    
                                <span class="text-orange-500 font-bold text-base sm:hidden sm:text-lg">
                                    ${{ number_format($dish->price, 2) }}
                                </span>
    
                                @if($dish->category)
                                    <a href="{{ route('categories.show', $dish->category->id) }}" class="hidden sm:inline-flex items-center bg-orange-100 text-orange-600 text-sm font-medium rounded-full px-3 py-1 hover:bg-orange-200 transition">
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
    
                            <div class="mt-auto flex gap-2">

                                <form
                                    action="{{ route('favorites.toggle', $dish->id) }}"
                                    method="POST"
                                    class="w-1/3">
                                    @csrf

                                    <button
                                        type="submit"
                                        title="Remove from favorites"
                                        class="w-full h-full min-h-10 bg-red-100 text-red-600 hover:bg-red-200 rounded-xl flex items-center justify-center transition">
                                        <i data-lucide="heart-off" class="sm:w-5 sm:h-5 w-4 h-4"></i>
                                    </button>
                                </form>

                                <div class="w-2/3">

                                    @if($dish->status === 'available')

                                        <button
                                            class="add-to-cart-btn w-full bg-orange-500 hover:bg-orange-600 text-white rounded-xl font-semibold py-2 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300 flex items-center justify-center gap-2"
                                            data-id="{{ $dish->id }}">

                                            {{ __('cart.add_to_cart') }}

                                        </button>

                                    @elseif($dish->status === 'coming_soon')

                                        <button
                                            disabled
                                            class="w-full py-2 rounded-xl bg-yellow-100 text-yellow-700 font-semibold cursor-not-allowed">
                                            Coming Soon
                                        </button>

                                    @else

                                        <button
                                            disabled
                                            class="w-full py-2 rounded-xl bg-red-100 text-red-700 font-semibold cursor-not-allowed">
                                            Out of Stock
                                        </button>

                                    @endif

                                </div>

                            </div>
    
                        </div>
                    </div>
    
                @endforeach

            </div>

        @endif
    </div>
</div>

@endsection