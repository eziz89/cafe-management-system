@extends('layouts.app')

@section('content')

<section class="bg-gray-50 min-h-screen pt-12">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">

        <p class="uppercase tracking-[0.3em] text-orange-400 font-semibold mb-2">
            {{ __('category.categories') }}
        </p>

        <h1 class="text-5xl font-bold text-neutral-900 mb-4">
            {{ __('category.categories') }}
        </h1>

        <p class="text-neutral-400 sm:mb-10 mb-6 max-w-2xl">
            {{ __('category.category_description') }}
        </p>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 sm:pb-20 pb-10">

            @foreach($categories as $category)

                <div class="group bg-white rounded-3xl relative overflow-hidden shadow-lg hover:-translate-y-2 border border-orange-200 hover:border-orange-500/40 transition duration-300">

                    <a href="{{ route('categories.show', $category->id) }}">

                        @if($category->image)

                            <div class="mb-5 overflow-hidden">

                                <img
                                    src="{{ asset('storage/' . $category->image) }}"
                                    alt="{{ $category->name }}"
                                    class="w-full h-28 sm:h-40 lg:h-48 object-cover transition duration-500 group-hover:scale-105">

                            </div>

                        @endif

                        <div class="absolute sm:top-1 sm:left-4 -top-1 left-2 z-3 pt-2">

                            <span class="bg-orange-100 text-orange-500 text-[10px] sm:text-sm px-2 sm:px-3 py-1 rounded-full">
                                {{ trans_choice('dish.dish_count', $category->dishes_count, ['count' => $category->dishes_count]) }}
                            </span>
                            
                        </div>

                        <h2 class="text-lg sm:text-xl lg:text-2xl px-3 sm:px-6 font-bold text-neutral-800 hover:text-orange-500 transition duration-300 my-3">
                            {{ $category->translated_name }}
                        </h2>

                        @if($category->description)

                            <p class="text-gray-500 leading-relaxed my-3 line-clamp-2 px-3 sm:px-6 text-sm sm:text-base">

                                {{ $category->description }}

                            </p>

                        @endif

                    </a>

                    @if($category->dishes->count())

                        <div class="hidden sm:block px-6 my-4">

                            <p class="font-semibold text-gray-700 mb-2">
                                Popular:
                            </p>

                            <ul class="space-y-1 text-gray-500 text-sm">

                                @foreach($category->dishes as $dish)

                                    <li class="flex justify-between">

                                        <span>
                                            {{ $dish->translated_name }}
                                        </span>

                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif

                </div>

            @endforeach

        </div>

    </div>

</section>

@endsection