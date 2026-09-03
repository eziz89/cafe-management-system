
@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        
        <div class="flex flex-row items-center justify-between sm:mb-8 mb-6 gap-4">

            <div>
                <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold sm:mb-4 mb-2">
                    Administrasiýa
                </p>

                <h1 class="sm:text-5xl text-4xl font-bold text-stone-900">
                    Dolandyryş paneli
                </h1>
            </div>

            <form method="POST" action="/logout" class="text-right">
                @csrf

                <button class="text-white bg-red-500 rounded-lg shadow-lg hover:bg-red-600 hover:shadow-lg hover:shadow-red-500/30 py-2 px-4 font-semibold transition duration-300">
                    Çykmak
                </button>
            </form>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 xl:grid-cols-3 gap-4">

            @include('admin.components.stat-card', [
                'title' => "Şu günki sargytlar",
                'value' => $stats['todayOrders']
            ])
            
            @include('admin.components.stat-card', [
                'title' => "Şu günki girdeji",
                'value' => '$'.$stats['todayRevenue']
            ])
            
            @include('admin.components.stat-card', [
                'title' => 'Garaşylýan sargytlar',
                'value' => $stats['pendingOrders']
            ])
            
            @include('admin.components.stat-card', [
                'title' => 'Elýeterli tagamlar',
                'value' => $stats['availableDishes']
            ])
            
            @include('admin.components.stat-card', [
                'title' => 'Ýakynda',
                'value' => $stats['comingSoonDishes']
            ])
            
            @include('admin.components.stat-card', [
                'title' => 'Ambarda ýok',
                'value' => $stats['outOfStockDishes']
            ])
            
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 my-6 sm:my-8">

            <a href="/admin/orders" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg hover:-translate-y-2 transition">

                <div class="text-4xl sm:text-5xl mb-4 sm:mb-6">
                    <i data-lucide="package" class="w-10 h-10 text-orange-500"></i>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold text-stone-800 mb-2 sm:mb-3">
                    Sargytlar
                </h2>

                <p class="text-sm sm:text-base text-stone-500">
                    Müşderilerden gelýän sargytlary dolandyryň.c
                </p>

            </a>

            <a href="/admin/reservations" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg hover:-translate-y-2 transition">

                <div class="text-4xl sm:text-5xl mb-4 sm:mb-6">
                    <i data-lucide="calendar-days" class="w-10 h-10 text-orange-500"></i>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold text-stone-800 mb-2 sm:mb-3">
                    Bronlamalar
                </h2>

                <p class="text-sm sm:text-base text-stone-500">
                    Bronlamalary gözden geçiriň we tertipleşdiriň.
                </p>

            </a>

            <a href="/admin/dishes" class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-8 shadow-lg hover:-translate-y-2 transition">

                <div class="text-4xl sm:text-5xl mb-4 sm:mb-6">
                    <i data-lucide="utensils" class="w-10 h-10 text-orange-500"></i>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold text-stone-800 mb-2 sm:mb-3">
                    Tagamlar
                </h2>

                <p class="text-sm sm:text-base text-stone-500">
                    Tagamlary we menýu punktlaryny täzeläň.
                </p>

            </a>

            <a href="/admin/categories" class="bg-white rounded-2xl sm:rounded-3xl
                    p-5 sm:p-8 shadow-lg
                    hover:-translate-y-2 transition">
                <div class="text-4xl sm:text-5xl mb-4 sm:mb-6">
                    <i data-lucide="folder" class="w-10 h-10 text-orange-500"></i>
                </div>

                <h2 class="text-xl sm:text-2xl font-bold text-stone-800 mb-2 sm:mb-3">
                    Kategoriýalar
                </h2>

                <p class="text-sm sm:text-base text-stone-500">
                    Menýu gurluşyny netijeli gurnaşdyryň.
                </p>

            </a>
        </div>
    </div>

@endsection