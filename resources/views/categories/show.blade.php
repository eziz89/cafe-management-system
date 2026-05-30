@extends('layouts.app')

@section('content')
<section class="bg-neutral-950 min-h-screen py-20 mb-24">
    <div class="max-w-7xl mx-auto">
        <div class="mb-16">
            <p class="text-orange-400 font-semibold uppercase tracking-widest mb-4">
                Menu Category
            </p>
            <h1 class="text-5xl font-bold text-white mb-6">
                {{ $category->name }}
            </h1>
            <p class="text-neutral-400 max-w-3xl text-lg">
                Discover carefully prepared dishes from our {{ strtolower($category->name) }} collection.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($category->dishes as $dish)
                <div class="bg-neutral-900/80 backdrop-blur rounded-3xl overflow-hidden shadow-2xl border border-neutral-800 hover:border-orange-500/40 hover:-translate-y-2 transition duration-300">
                    <a href="/menu/{{ $dish->id }}" class="overflow-hidden">
                        @if($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-64 object-cover hover:scale-105 transition duration-500">
                        @endif
                    </a>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">

                            <a href="/menu/{{ $dish->id }}">
                                <h2 class="text-2xl font-bold text-white hover:text-orange-500 transition">
                                        {{ $dish->name }}
                                </h2>
                            </a>

                            <span class="text-orange-400 font-bold text-lg">
                                ${{ $dish->price }}
                            </span>
                        </div>

                        <p class="text-neutral-400 mb-6 leading-relaxed">
                            {{ Str::limit($dish->description, 80) }}
                        </p>

                        @php
                            $avg = $dish->ratings->avg('rating');
                        @endphp

                        <p class="text-white">⭐ {{ number_format($avg, 1) }}/5</p>

                        <form action="{{ route('cart.add', $dish->id) }}" method="POST">
                            @csrf

                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white py-3 rounded-2xl font-semibold transition duration-300 mt-4">
                                Add to Cart
                            </button>
                        </form>

                    </div>
                </div>
                
            @endforeach
        </div>
    </div>

</section>
@endsection