@extends('layouts.app')

@section('content')
    <h1 class="text-5xl font-bold m-6 pt-4">Our Menu</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if($dishes->isEmpty())
            <p>No dishes available yet.</p>
        @else
            @foreach($dishes as $dish)

                <div class="bg-white rounded-2xl shadow-lg p-4">
                    @if($dish->image)
                        <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-80 object-cover rounded mb-3">
                    @endif

                    <h2 class="text-2xl font-semibold">{{ $dish->name }}</h2>
                    <p class="text-gray-600 text-sm mt-2">{{ Str::limit($dish->description, 100) }}</p>
                    @if($dish->category)
                        <span class="inline-block bg-orange-100 text-orange-700 text-sm px-3 py-1 rounded-full mt-3">
                            {{ $dish->category->name }}
                        </span>
                    @endif
                    <p class="text-green-600 font-bold mt-4">Price: ${{ number_format($dish->price, 2) }}</p>
                    <form action="/cart/add/{{ $dish->id }}" method="POST">
                        @csrf
                        
                        <button class="bg-black text-white px-4 py-2 rounded-lg mt-4 w-full hover:bg-gray-800 transition">
                            Add to Cart
                        </button>
                    </form>
                    <a href="/menu/{{ $dish->id }}" class="inline-block mt-3 text-blue-500">
                        View Details ->
                    </a>
                </div>
            @endforeach
        @endif
    </div>
@endsection