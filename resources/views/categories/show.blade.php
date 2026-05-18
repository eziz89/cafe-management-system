@extends('layouts.app')

@section('content')
    <section class="bg-neutral-950 min-h-screen py-20">
    <div class="max-w-7xl mx-auto px-6">
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
                    <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-64 object-cover hover:scale-105 transition duration-500">

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="text-2xl font-bold text-white">
                                {{ $dish->name }}
                            </h2>
                            <span class="text-orange-400 font-bold text-lg">
                                ${{ $dish->price }}
                            </span>
                        </div>

                        <p class="text-neutral-400 mb-6 leading-relaxed">
                            {{ Str::limit($dish->description, 100) }}
                        </p>
                        <form action="{{ route('cart.add', $dish->id) }}" method="POST">
                            @csrf

                            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white py-3 rounded-2xl font-semibold transition duration-300">
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