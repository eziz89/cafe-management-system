@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">

            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                    Admin Panel
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

        <div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

            <div class="flex flex-col md:flex-row gap-4">

                <div class="flex-1">
                    <input
                        id="dish-search"
                        type="text"
                        placeholder="🔍 Search dishes..."
                        class="w-full px-5 py-3 rounded-2xl border border-stone-200
                               focus:outline-none focus:ring-2 focus:ring-orange-300">
                </div>

                <select
                    id="category-filter"
                    class="px-5 py-3 rounded-2xl border border-stone-200
                           focus:outline-none focus:ring-2 focus:ring-orange-300">

                    <option value="">All Categories</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

            </div>

        </div>

        <div id="table-wrapper">
            <div id="dishes-table">
                @include('admin.dishes.partials.table')
            </div>
        </div>

    </div>
@endsection