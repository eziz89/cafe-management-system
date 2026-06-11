@extends('layouts.app')

@section('content')

<div class="bg-gray-50 pt-14 pb-20">
    <div class="max-w-7xl mx-auto">

        @if($dishes->isEmpty())
            
            <div class="text-center py-12">
                <div class="text-6xl mb-4">💔</div>
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

            <h1 class="text-3xl font-bold mb-6">
                My Favorites
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($dishes as $dish)
    
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300 flex flex-col">
                        <a href="/menu/{{ $dish->id }}" class="overflow-hidden">
                    
                            @if($dish->image)
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-56 object-cover hover:scale-105 transition duration-500">
                            @endif
                
                        </a>
                        
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
    
                            <form action="{{ route('favorites.toggle', $dish->id) }}" method="POST">
                                @csrf
    
                                <button class="mb-3 w-full bg-red-100 text-red-600 hover:bg-red-200 transition py-2 rounded-xl">
                                    ❤️ Remove
                                </button>
                            </form>
    
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

        @endif
    </div>
</div>

@endsection