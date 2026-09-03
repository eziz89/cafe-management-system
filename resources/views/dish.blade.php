
@extends('layouts.app')

@section('content')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 bg-gray-100 pb-12 pt-10 px-6">

            <div class="relative bg-white rounded-2xl border-2 border-gray-300 shadow-s p-5">
                
                <img src="{{ asset('storage/' . $dish->image) }}" class="w-full h-64 sm:h-72 object-cover rounded-xl mb-5">

                @if($dish->status === 'coming_soon')

                    <span class="absolute top-3 left-3
                                bg-yellow-100 text-yellow-700
                                border border-yellow-500
                                px-3 py-2 rounded-full
                                text-xs sm:text-sm font-semibold">

                        {{ __('dish.coming_soon') }}

                    </span>

                @elseif($dish->status === 'out_of_stock')

                    <span class="absolute top-3 left-3
                                bg-red-100 text-red-700
                                border border-red-500
                                px-3 py-2 rounded-full
                                text-xs sm:text-sm font-semibold">

                        {{ __('dish.out_of_stock') }}

                    </span>

                @endif

                <h1 class="text-4xl font-bold text-gray-900 mb-3">
                    {{ $dish->translated_name }}
                </h1>

                <p class="sm:text-3xl text-2xl font-bold text-orange-500 sm:mb-5 mb-3">
                    ${{ $dish->price }}
                </p>

                <p class="text-gray-600 leading-relaxed sm:mb-8 mb-5">
                    {{ $dish->translated_description }}
                </p>

                <div class="flex gap-2 mt-6">
                
                    @auth
                        @php
                            $isFavorited = auth()->user()->favorites->contains($dish->id);
                        @endphp
                
                        <button
                            type="button"
                            class="favorite-btn w-1/3 min-h-11 rounded-xl
                                   flex items-center justify-center
                                   transition
                                   {{ $isFavorited
                                        ? 'bg-red-500 text-white'
                                        : 'bg-red-100 text-red-500 hover:bg-red-200' }}"
                            data-id="{{ $dish->id }}"
                            title="{{ $isFavorited ? 'Remove from favorites' : 'Add to favorites' }}">
                
                            <i
                                data-lucide="heart"
                                class="w-5 h-5 {{ $isFavorited ? 'fill-current' : '' }}">
                            </i>
                
                        </button>
                    @endauth
                
                
                    <div class="{{ auth()->check() ? 'w-2/3' : 'w-full' }}">
                
                        @if($dish->status === 'available')
                
                            <form action="/cart/add/{{ $dish->id }}" method="POST">
                                @csrf
                
                                <button
                                    type="submit"
                                    class="w-full bg-orange-500 hover:bg-orange-600
                                           hover:shadow-lg hover:shadow-orange-500/30
                                           text-white py-3 rounded-xl font-semibold
                                           transition duration-300">
                
                                    {{ __('cart.add_to_cart') }}
                
                                </button>
                
                            </form>
                
                        @elseif($dish->status === 'coming_soon')
                
                            <button
                                disabled
                                class="w-full min-h-11 rounded-xl
                                       bg-yellow-100 text-yellow-700
                                       font-semibold cursor-not-allowed">
                
                                {{ __('dish.coming_soon') }}
                
                            </button>
                
                        @else
                
                            <button
                                disabled
                                class="w-full min-h-11 rounded-xl
                                       bg-red-100 text-red-700
                                       font-semibold cursor-not-allowed">
                
                                {{ __('dish.out_of_stock') }}
                
                            </button>
                
                        @endif
                
                    </div>
                
                </div>

                <a href="/menu" class="text-orange-500 mt-4 inline-block">
                    <- {{ __('menu.back_to_menu') }}
                </a>
            </div>

            <div class="lg:col-span-2 bg-white border-2 border-gray-300 rounded-2xl shadow-sm sm:p-8 p-6">
                <h2 class="text-3xl font-bold text-gray-900 sm:mb-8 mb-5">
                    {{ __('review.customer_reviews') }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 sm:gap-10 gap-6 mb-10">

                    <div>
                        @php
                            $avg = $dish->ratings->avg('rating');
                        @endphp

                        <h1 class="sm:text-7xl text-6xl font-bold text-gray-900 sm:mb-4">
                            {{ $avg ? number_format($avg, 1) : '—' }}
                        </h1>

                        <div class="flex gap-1 text-yellow-400 sm:mb-3 mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i data-lucide="star" class="w-7 h-7 fill-current"></i>
                            @endfor
                        </div>

                        <p class="text-gray-400">
                            {{ __('review.based_on') }}
                            {{ $dish->ratings->count() }}
                            {{ trans_choice('review.review_count', $dish->ratings->count()) }}
                        </p>
                    </div>

                    <div class="space-y-4">
                        @for($i = 5; $i >= 1; $i--)

                            @php
                                $count = $dish->ratings->where('rating', $i)->count();
                                $percentage = $dish->ratings->count() > 0 ? ($count / $dish->ratings->count()) * 100 : 0;
                            @endphp

                            <div class="flex items-center gap-4">

                                <div class="flex items-center text-sm font-medium gap-1">
                                    {{ $i }}<i data-lucide="star" class="w-4 h-4 fill-current text-yellow-400"></i>
                                </div>

                                <div class="flex-1 bg-gray-200 h-2 rounded-full">

                                    <div class="bg-orange-400 h-2 rounded-full" style="width: {{ $percentage }}%">
                                    </div>

                                </div>

                                <span class="text-sm text-gray-500 w-12">
                                    {{ round($percentage) }}%
                                </span>

                            </div>

                        @endfor

                    </div>

                </div>

                <div class="bg-gray-50 rounded-2xl p-6 sm:mb-10 mb-6">

                    @guest

                        <div class="bg-orange-50 border border-orange-200 text-orange-700 rounded-2xl p-4 mb-6">
                            Please
                            <a href="{{ route('login') }}" class="font-semibold underline">
                                log in
                            </a>
                            to leave a rating or review.
                        </div>
                    @endguest

                    <form method="POST" action="{{ route('dishes.review', $dish->id) }}">
                        @csrf

                        <div class="grid md:grid-cols-2 sm:gap-8">

                            <div>
                                <h3 class="text-xl font-semibold sm:mb-4 mb-2">
                                    {{ __('review.share_rating') }}
                                </h3>

                                <p class="text-gray-500 sm:mb-6 mb-2">
                                    {{ __('review.rate_dish') }}
                                </p>

                                <div class="rating flex flex-row-reverse justify-end gap-2 sm:mb-6 mb-5 text-3xl">

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

                            <div>

                                <h3 class="text-xl font-semibold mb-4">
                                    {{ __('review.write_review') }}
                                </h3>

                                <textarea
                                    name="comment"
                                    rows="4"
                                    placeholder="{{ __('review.share_experience') }}"
                                    class="w-full border border-gray-300 rounded-2xl
                                        p-4 resize-none focus:ring-2
                                        focus:ring-orange-400 focus:outline-none"></textarea>

                                <div class="flex justify-end sm:mt-5 mt-3">

                                    <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-8 sm:py-3 py-2 rounded-2xl font-medium transition">
                                        {{ __('review.submit_review') }}
                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>
                </div>

                <div class="space-y-5">

                    @foreach($dish->ratings as $rating)

                        @php
                            $comment = $dish->comments->where('user_id', $rating->user_id)->first();
                        @endphp

                        <div class="bg-white border border-gray-300 shadow rounded-3xl sm:p-6 p-4">

                            <div class="flex items-start gap-4">

                                <div class="rounded-full bg-gray-200 sm:p-4 p-3 shrink-0">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                </div>

                                <div class="min-w-0">

                                    <h4 class="font-bold text-lg">
                                        {{ $rating->user->name }}
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        {{ $rating->created_at->diffForHumans() }}
                                    </p>

                                    {{-- Rating --}}
                                    <div class="flex items-center gap-1 mt-2">

                                        @for($i = 1; $i <= 5; $i++)

                                            <i
                                                data-lucide="star"
                                                class="w-4 h-4
                                                    {{ $i <= $rating->rating
                                                        ? 'fill-current text-yellow-400'
                                                        : 'text-gray-300' }}">
                                            </i>

                                        @endfor

                                    </div>

                                </div>

                            </div>

                            @if($rating->comment)

                                <p class="text-gray-700 leading-relaxed mt-4">
                                    {{ $rating->comment->comment }}
                                </p>

                            @endif

                        </div>

                    @endforeach

                    @foreach($dish->comments as $comment)

                        <div class="bg-white border border-gray-300 shadow rounded-3xl sm:p-6 p-4">
                    
                            <div class="flex items-center gap-4 mb-4">
                    
                                <div class="rounded-full bg-gray-200 sm:p-4 p-3">
                                    <i data-lucide="user" class="w-5 h-5"></i>
                                </div>
                    
                                <div>
                                    <h4 class="font-bold text-lg">
                                        {{ $comment->user->name }}
                                    </h4>
                    
                                    <p class="text-sm text-gray-500">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </p>
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
