 @extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto sm:pt-4 pb-6 px-4 sm:px-0">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between sm:mb-6 mb-6">

            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                    Administrasiýa
                </p>

                <h1 class="text-4xl font-bold text-stone-900">
                    <div class="flex items-center gap-2">
                        <i data-lucide="utensils" class="w-8 h-8 text-orange-500"></i>
                        Tagamlar
                    </div>
                </h1>

                <p class="text-stone-500">
                    Restoran menýuňyzdaky tagamlary dolandyryň.
                </p>
            </div>

            <a href="/admin/dishes/create"
                class="mt-6 md:mt-0 w-full md:w-auto justify-center
                    inline-flex items-center gap-2
                    bg-orange-500 hover:bg-orange-600
                    text-white font-semibold
                    px-6 sm:py-3 py-2 rounded-2xl
                    shadow-lg hover:shadow-orange-500/30
                    transition">

                <i data-lucide="plus" class="w-5 h-5"></i>

                Tagam goş

            </a>

        </div>

        <div class="grid grid-cols-2 xl:grid-cols-4 gap-3 sm:gap-6 mb-6">

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="flex items-center text-stone-500 gap-2">
                    <i data-lucide="utensils" class="w-6 h-6"></i>
                    Jemi tagamlar
                </p>
                <h2 class="sm:text-3xl text-2xl font-bold mt-2">  
                    {{ $dishes->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="flex items-center text-stone-500 gap-2">
                    <i data-lucide="folders" class="w-6 h-6"></i>
                    Kategoriýalar
                </p>
                <h2 class="sm:text-3xl text-2xl font-bold mt-2">
                    {{ $stats['totalCategories'] }}
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="flex items-center text-stone-500 gap-2">
                    <i data-lucide="badge-dollar-sign" class="w-6 h-6"></i>
                    Ortaça Baha
                </p>
                <h2 class="sm:text-3xl text-2xl font-bold mt-2">
                    {{ number_format($dishes->avg('price'),2) }} TMT
                </h2>
            </div>

            <div class="bg-white rounded-3xl shadow-lg p-6">
                <p class="flex items-center text-stone-500 gap-2">
                    <i data-lucide="trending-up" class="w-6 h-6"></i>
                    Iň ýokary Baha
                </p>
                <h2 class="sm:text-3xl text-2xl font-bold mt-2">
                    {{ number_format($dishes->max('price'),2) }} TMT
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