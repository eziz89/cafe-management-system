@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto sm:pt-4 pb-8 px-4 sm:px-6 lg:px-0">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between sm:mb-10 mb-6">
        
        <div>

            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Menýu kategoriýasy
            </p>

            <h1 class=" sm:text-4xl text-3xl font-bold text-stone-900">
                {{ $category->name }}
            </h1>

            <p class="text-stone-500 mt-2 flex items-center gap-2">

                <i data-lucide="utensils" class="w-4 h-4"></i>
            
                Bu kategoriýada {{ $category->dishes->count() }}
                {{ Str('tagam', $category->dishes->count()) }}
                bar.
            
            </p>

        </div>

        <a href="{{ route('admin.dishes.create', ['category' => $category->id]) }}" class="mt-6 md:mt-0 w-full md:w-auto justify-center
            inline-flex items-center gap-2
            bg-orange-500 hover:bg-orange-600
            text-white font-semibold
            px-6 sm:py-3 py-2 rounded-2xl
            shadow-lg hover:shadow-orange-500/30
            transition">

            <i data-lucide="plus" class="w-5 h-5"></i>
            Bu kategoriýa tagam goşuň
        </a>

    </div>

    @include('admin.dishes.partials.filters', [
        'hideCategory' => true
    ])
        
        <div id="dishes-table">
            @include('admin.dishes.partials.table', [
                'hideCategory' => true
            ])
        </div>
 
@endsection