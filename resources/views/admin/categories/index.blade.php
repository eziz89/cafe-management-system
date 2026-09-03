@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto pt-4 pb-8 px-4 sm:px-6 lg:px-0">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">

            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                    Administrasiýa
                </p>

                <h1 class="flex items-center sm:text-4xl text-3xl font-bold text-stone-900 gap-2">
                    <i data-lucide="folders" class="w-8 h-8 text-orange-500"></i>
                    Kategoriýalar
                </h1>

                <p class="text-stone-500 mt-2">
                    Restoran menýuňyzdaky tagamlary dolandyryň.
                </p>
            </div>

            <a href="/admin/categories/create"
                class="mt-6 md:mt-0 w-full md:w-auto justify-center
                    inline-flex items-center gap-2
                    bg-orange-500 hover:bg-orange-600
                    text-white font-semibold
                    px-6 sm:py-3 py-2 rounded-2xl
                    shadow-lg hover:shadow-orange-500/30
                    transition">

                <i data-lucide="plus" class="w-5 h-5"></i>

                Kategoriýa goş

            </a>

        </div>
            
        <div class="grid grid-cols-1 md:grid-cols-3 sm:gap-6 gap-4 sm:mb-8 mb-6">

            <div class="bg-white rounded-3xl shadow-lg p-5 sm:p-6">
                <p class="text-stone-500">Jemi Kategoriýalar</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $categories->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-5 sm:p-6">
                <p class="text-stone-500">Jemi Tagamlar</p>
                <h2 class="text-3xl font-bold mt-2">
                    {{ $categories->sum('dishes_count') }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-5 sm:p-6">
                <p class="text-stone-500">Iň Meşhur</p>

                @php
                    $mostPopular = $categories->sortByDesc('dishes_count')->first();
                @endphp

                <h2 class="text-2xl font-bold mt-2">
                    {{ $mostPopular?->translated_name ?? '-' }}
                </h2>
                
            </div>
            
        </div>

        <div id="table-wrapper">
            <div id="categories-table">
                @include('admin.categories.partials.table')
            </div>
        </div>
@endsection