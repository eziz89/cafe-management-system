@extends('layouts.app')

@section('content')

    <section class="grid md:grid-cols-2 gap-12 items-center py-20">
        <div>
            <p class="text-orange-500 font-semibold uppercase tracking-widest mb-4">
                Welcome to Our Café
            </p>

            <h1 class="text-5xl font-bold leading-tight mb-6">
                Delicious Food,
                Comfortable Atmosphere,
                Memorable Experience.
            </h1>

            <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                Discover our carefully crafted dishes, reserve your table effortlessly,
                and enjoy a modern café experience designed for comfort and flavor.
            </p>

            <div class="flex gap-4">
                <a href="/categories" class="bg-black text-white px-8 py-4 rounded-2xl hover:scale-105 transition">
                    Browse Menu
                </a>
                <a href="/reservations/create" class="border border-black px-8 py-4 rounded-2xl hover:bg-black hover:text-white transition">
                    Reserve Table
                </a>
            </div>
        </div>

        <div>
            <img
                src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5"
                class="rounded-2xl shadow-2xl h-[500px] w-full object-cover"
            >
        </div>
    </section>

    <section class="pb-16">

        <section class="py-18 text-stone-800 px-15">
            <div class="mb-12">
                    <p class="text-orange-500 text-center uppercase tracking-[0.3em] mb-4 font-semibold">
                        Categories
                    </p>
                    <h2 class="text-4xl text-black text-center font-bold leading-tight">
                        Explore Our Culinary Selection
                    </h2>
            </div>

            <div class="bg-white rounded-[2rem] shadow-lg p-12">
                <a href="/categories" class="text-lg font-semibold text-orange-500">
                    <p class="text-center pb-8">View All →</p>
                </a>
                <div class="grid md:grid-cols-3 gap-8">

                    @foreach($categories as $category)


                        <a href="/categories/{{ $category->id }}"
                           class="bg-neutral-800 rounded-[1rem] p-10
                                shadow-md hover:shadow-2xl
                                hover:-translate-y-2 border border-orange-800
                                transition duration-300">

                            <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center mb-8">
                                <span class="text-3xl">
                                    🍴
                                </span>
                            </div>
                            <h3 class="text-white text-3xl font-bold mb-4">
                                {{ $category->name }}
                            </h3>
                            <p class="text-gray-400 leading-relaxed">
                                Carefully curated dishes designed for flavor and comfort.
                            </p>
                        </a>

                    @endforeach
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 py-20" id="featured-dishes">

            <div class="flex justify-between items-center mb-12">
                <div>
                    <p class="text-orange-500 uppercase tracking-widest font-semibold">
                        Featured Dishes
                    </p>

                    <h2 class="text-4xl font-bold text-gray-800 mt-2">
                        Customer Favorites
                    </h2>
                </div>

                <a href="/menu"
                   class="text-orange-500 hover:text-orange-600 font-medium">
                    View Full Menu →
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($featuredDishes as $dish)

                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition duration-300">
                        <img src="{{ asset('storage/' . $dish->image) }}" class="w-full h-64 object-cover">

                        <div class="p-6">

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-2xl font-bold text-gray-800">
                                    {{ $dish->name }}
                                </h3>

                                <span class="text-orange-500 font-bold text-xl">
                                    ${{ $dish->price }}
                                </span>
                            </div>

                            <p class="text-gray-500 mb-6">
                                {{ Str::limit($dish->description, 90) }}
                            </p>

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

                        </div>

                    </div>

                @endforeach

            </div>

        </section>

        <section class="max-w-7xl mx-auto px-6 pt-14">

            <div class="text-center mb-14">
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold">
                    Location
                </p>
                <h2 class="text-5xl font-bold mt-4">
                    Visit Our Cafe
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto mt-4">
                    Experience delicious food, a cozy atmosphere, and unforgettable moments in our cafe.
                </p>
            </div>

            
            <div class="bg-white rounded-[2rem] shadow-lg p-12">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div class="space-y-6">
                        <div class="bg-neutral-900 border border-orange-800 backdrop-blur rounded-2xl p-6">
                            <h3 class="text-xl text-white font-semibold mb-3">📍 Where to find us</h3>
                            <p class="text-gray-400">Ashgabat, Turkmenistan</p>
                            <a href="https://www.google.com/maps?q=Ashgabat"
                               target="_blank"
                               class="block text-center text-white hover:text-white bg-neutral-800 rounded-xl hover:bg-orange-500 hover:shadow-lg hover:shadow-orange-500/30 border border-orange-700 transition duration-300 py-1 mt-4">
                                Open in Google Maps
                            </a>
                        </div>

                        <div class="bg-neutral-900 border border-orange-800 backdrop-blur rounded-2xl p-6">
                            <h3 class="text-xl text-white font-semibold mb-3">🕒 Opening Hours</h3>

                            <p class="text-gray-400">Mon - Fri: 8:00 AM - 10:00 PM</p>
                            <p class="text-gray-400">Sat: 9:00 AM - 11:00 PM</p>
                            <p class="text-gray-400">Sun: 9:00 AM - 9:00 PM</p>
                        </div>

                        <div class="bg-neutral-900 border border-orange-800 backdrop-blur rounded-2xl px-6 py-4">
                            <h3 class="text-xl text-white font-semibold mb-3">📞 Contact</h3>

                            <p class="text-gray-400">+993 XX XXX XXX</p>
                            <a href="tel:+993XXXXXXXX" class="block text-center text-white hover:text-white bg-neutral-800 rounded-xl hover:bg-orange-500 hover:shadow-lg hover:shadow-orange-500/30 border border-orange-700 transition duration-300 py-1 mt-2 mb-4">
                                Call Us
                            </a>
                            <p class="text-gray-400">canteen@example.com</p>
                            <a href="mailto:canteen@example.com"
                               class="block text-center text-white hover:text-neutral-800 hover:font-semibold bg-neutral-800 rounded-xl hover:bg-orange-500 hover:shadow-lg hover:shadow-orange-500/30 border border-orange-700 transition duration-300 py-1 mt-2 mb-2">
                                Send Email
                            </a>
                        </div>
                    </div>

                    <div class="lg:sticky top-24 rounded-2xl overflow-hidden h-[500px]">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2191.1350298792936!2d58.37954730480198!3d37.941600536293755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6fff2c4815c659%3A0x834c6009e5b9958c!2z0JrQsNGE0LUgIkdVQkFEQUcgRklUw4dJIiBBxZ9nYWJhdA!5e1!3m2!1sen!2sus!4v1779367071390!5m2!1sen!2sus" 
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

        </section>
    </section>

@endsection