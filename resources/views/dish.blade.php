@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto bg-white p-6 rounded-2xl shadow mt-16">
        @if($dish->image)
            <img src="{{ asset('storage/' . $dish->image) }}" class="w-full h-90 object-cover rounded mb-4">
        @endif
        <h1 class="text-3xl font-bold">{{ $dish->name }}</h1>

        <p class="text-gray-600 mt-2">{{ $dish->description }}</p>
        <p class="text-xl mt-4 font-bold mb-2">Price: ${{ $dish->price }}</p>

        @php
            $avg = $dish->ratings->avg('rating');
        @endphp

        <p>⭐ {{ number_format($avg, 1) ?: 'No ratings yet' }}/5</p>

        <form action="{{ route('dishes.rate', $dish->id) }}" method="POST">
            @csrf

            <select name="rating">
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select>

            <button type="submit">
                Submit Rating
            </button>
        </form>

        <form action="{{ route('dishes.comment', $dish->id) }}" method="POST">
            @csrf

            <textarea name="comment" rows="4" placeholder="Write your opinion about this dish..." required></textarea>
            <button type="submit">
                Add Comment
            </button>
        </form>
        @foreach($dish->comments as $comment)

            <div>
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->comment }}</p>
                <small>{{ $comment->created_at->diffForHumans() }}</small>
            </div>

        @endforeach

        <form action="/cart/add/{{ $dish->id }}" method="POST">
            @csrf
            
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white py-3 rounded-2xl font-semibold transition duration-300 mt-4">
                Add to Cart
            </button>
        </form>

        <a href="/menu" class="text-blue-500 mt-4 inline-block">
            <- Back to menu
        </a>
    </div>
@endsection
