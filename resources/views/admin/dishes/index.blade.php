 
@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto pt-4 pb-6">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">

            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                    Administration
                </p>

                <h1 class="text-4xl font-bold text-stone-900">
                    🍽 Dishes
                </h1>

                <p class="text-stone-500 mt-2">
                    Manage your restaurant menu items.
                </p>
            </div>

            <a href="/admin/dishes/create"
                class="mt-6 md:mt-0 inline-flex items-center gap-2
                       bg-orange-500 hover:bg-orange-600
                       text-white font-semibold
                       px-6 py-3 rounded-2xl
                       shadow-lg hover:shadow-orange-500/30
                       transition">

                <span class="text-xl">+</span>

                Add Dish

            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-10">

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Total Dishes</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $dishes->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Categories</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $stats['totalCategories'] }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Average Price</p>
                <h2 class="text-3xl font-bold mt-2">
                    ${{ number_format($dishes->avg('price'),2) }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Highest Price</p>
                <h2 class="text-3xl font-bold mt-2">
                    ${{ number_format($dishes->max('price'),2) }}
                </h2>
            </div>

        </div>

        @include('admin.dishes.partials.filters')

        <div id="table-wrapper">
            <div id="dishes-table">
                @include('admin.dishes.partials.table', [
                    'dishes' => $dishes
                ])
            </div>
        </div>

    </div>
@endsection