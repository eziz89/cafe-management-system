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
                    <p class="text-green-600 font-bold mt-4 mb-2">Price: ${{ number_format($dish->price, 2) }}</p>
                    
                    @php
                        $avg = $dish->ratings->avg('rating');
                    @endphp

                    <p>⭐ {{ number_format($avg, 1) }}/5</p>

                    @foreach($dish->comments as $comment)

                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                            <p>{{ $comment->comment }}</p>
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                        </div>

                    @endforeach

                    <form action="{{ route('cart.add', $dish->id) }}" method="POST">
                            @csrf

                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white py-3 rounded-2xl font-semibold transition duration-300 mt-4">
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