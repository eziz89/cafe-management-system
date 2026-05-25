@extends('layouts.app')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10">
            <div class="bg-white rounded-2xl border-2 border-gray-800 shadow-sm b p-5">

                <img src="{{ asset('storage/' . $dish->image) }}"
                     class="w-full h-72 object-cover rounded-xl mb-5">

                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    {{ $dish->name }}
                </h1>

                <p class="text-3xl font-bold text-orange-500 mb-5">
                    ${{ $dish->price }}
                </p>

                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ $dish->description }}
                </p>

                <div class="space-y-4 text-gray-700">

                    <div class="flex items-center gap-3">
                        ⏱ <span>20–25 mins</span>
                    </div>

                    <div class="flex items-center gap-3">
                        🌶 <span>Spicy</span>
                    </div>

                    <div class="flex items-center gap-3">
                        🥬 <span>Vegetarian Option</span>
                    </div>
                </div>

                <form action="/cart/add/{{ $dish->id }}" method="POST">
                    @csrf

                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/30 text-white py-3 rounded-xl font-semibold transition duration-300 mt-6">
                        Add to Cart
                    </button>
                </form>

                <a href="/menu" class="text-blue-500 mt-4 inline-block">
                    <- Back to menu
                </a>
            </div>

            <div class="lg:col-span-2 bg-white border-2 border-gray-800 rounded-2xl shadow-sm p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">
                    Customer Reviews
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
                    <div>
                        @php
                            $avg = $dish->ratings->avg('rating');
                        @endphp

                        <h1 class="text-7xl font-bold text-gray-900 mb-4">
                            {{ number_format($avg, 1) }}
                        </h1>

                        <div class="text-yellow-300 text-4xl mb-3">
                            ★★★★☆
                        </div>

                        <p class="text-gray-400">
                            Based on
                            {{ $dish->ratings->count() }}
                            {{ $dish->ratings->count() == 1 ? 'review' : 'reviews' }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        @for($i = 5; $i >= 1; $i--)

                            @php
                                $count = $dish->ratings->where('rating', $i)->count();
                                $percentage = $dish->ratings->count() > 0 ? ($count / $dish->ratings->count()) * 100 : 0;
                            @endphp

                            <div class="flex items-center gap-4">

                                <span class="w-6 text-sm font-medium">
                                    {{ $i }}⭐
                                </span>

                                <div class="flex-1 bg-gray-200 h-2 rounded-full">

                                    <div
                                        class="bg-orange-400 h-2 rounded-full"
                                        style="width: {{ $percentage }}%">
                                    </div>

                                </div>

                                <span class="text-sm text-gray-500 w-12">
                                    {{ round($percentage) }}%
                                </span>

                            </div>

                        @endfor

                    </div>

                </div>

                <div class="bg-gray-50 rounded-2xl p-6 mb-10">
                    <form method="POST"
      action="{{ route('dishes.review', $dish->id) }}">

    @csrf

    <div class="grid md:grid-cols-2 gap-8">

        {{-- LEFT SIDE --}}
        <div>

            <h3 class="text-xl font-semibold mb-4">
                Share your rating
            </h3>

            <p class="text-gray-500 mb-6">
                How would you rate this dish?
            </p>

            <div class="rating flex flex-row-reverse justify-end gap-2 mb-6">

                @for($i = 5; $i >= 1; $i--)

                    <input type="radio"
                           name="rating"
                           id="star{{ $i }}-{{ $dish->id }}"
                           value="{{ $i }}"
                           hidden>

                    <label for="star{{ $i }}-{{ $dish->id }}">
                        ★
                    </label>

                @endfor

            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div>

            <h3 class="text-xl font-semibold mb-4">
                Write a review (optional)
            </h3>

            <textarea
                name="comment"
                rows="5"
                placeholder="Share your experience with this dish..."
                class="w-full border border-gray-300 rounded-2xl
                       p-4 resize-none focus:ring-2
                       focus:ring-orange-400 focus:outline-none"></textarea>

            <div class="flex justify-end mt-5">

                <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600
                           text-white px-8 py-3 rounded-2xl
                           font-medium transition">

                    Submit Review

                </button>

            </div>

        </div>

    </div>

</form>
                </div>

                <div class="space-y-5">
                    @foreach($dish->comments as $comment)

                        <div class="bg-white border border-gray-300 shadow rounded-3xl p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gray-200"></div>

                                    <div>
                                        <h4 class="font-bold text-lg">
                                            {{ $comment->user->name }}
                                        </h4>
                                        <p class="text-sm text-gray-500">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>

                                </div>
                            </div>

                            <p class="text-gray-700 leading-relaxed">
                                {{ $comment->comment }}
                            </p>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    </div> 

@endsection
