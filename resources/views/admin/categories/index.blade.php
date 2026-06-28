@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto px-6 py-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-10">

            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                    Admin Panel
                </p>

                <h1 class="text-4xl font-bold text-stone-900">
                    📂 Categories
                </h1>

                <p class="text-stone-500 mt-2">
                    Manage your restaurant menu items.
                </p>
            </div>

            <a href="/admin/categories/create"
                class="mt-6 md:mt-0 inline-flex items-center gap-2
                       bg-orange-500 hover:bg-orange-600
                       text-white font-semibold
                       px-6 py-3 rounded-2xl
                       shadow-lg hover:shadow-orange-500/30
                       transition">

                <span class="text-xl">+</span>

                Add Category

            </a>

        </div>
            
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Total Categories</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $categories->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Total Dishes</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $categories->sum('dishes_count') }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="text-stone-500">Most Popular</p>
                <h2 class="text-2xl font-bold mt-2">
                    {{ $categories->sortByDesc('dishes_count')->first()->name ?? '-' }}
                </h2>
            </div>
            
        </div>

        <div id="table-wrapper">
            <div id="categories-table">
                @include('admin.categories.partials.table')
            </div>
        </div>
@endsection