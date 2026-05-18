@extends('layouts.app')

@section('content')
    <a href="/cart" class="font-bold">Cart</a>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow">
        @if($dish->image)
            <img src="{{ asset('storage/' . $dish->image) }}" class="w-full h-90 object-cover rounded mb-4">
        @endif

        <h1 class="text-3xl font-bold">{{ $dish->name }}</h1>

        <p class="text-gray-600 mt-2">{{ $dish->description }}</p>
        <p class="text-xl mt-4 font-bold">Price: ${{ $dish->price }}</p>
        <form action="/cart/add/{{ $dish->id }}" method="POST">
            @csrf
            
            <button class="bg-black text-white px-4 py-2 rounded-lg mt-4 w-full hover:bg-gray-800 transition">
                Add to Cart
            </button>
        </form>
        <a href="/menu" class="text-blue-500 mt-4 inline-block">
            <- Back to menu
        </a>
    </div>
@endsection
