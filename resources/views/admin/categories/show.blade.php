@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto pt-4 pb-8">


    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">
        
        <div>

            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Category
            </p>

            <h1 class="text-4xl font-bold text-stone-900">
                {{ $category->name }}
            </h1>

            <p class="text-stone-500 mt-2">
                {{ $category->dishes->count() }} dishes in this category.
            </p>

        </div>

        <a href="{{ route('admin.dishes.create', ['category' => $category->id]) }}" class="mt-6 md:mt-0 inline-flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-2xl shadow-lg hover:shadow-orange-500/30 transition">
            + Add Dish to Category
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