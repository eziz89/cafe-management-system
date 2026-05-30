@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto">
        <form method="POST" action="/logout" class="text-right">
            @csrf

            <button class="text-white bg-red-500 rounded-lg shadow-lg hover:bg-red-600 hover:shadow-lg hover:shadow-red-500/30 py-2 px-4 font-semibold transition duration-300">
                Logout
            </button>
        </form>

        <div class="mb-14">
            <p class="text-orange-500 uppercase tracking-[0.3em]
                      font-semibold mb-4">
                Administration
            </p>
            <h1 class="text-5xl font-bold text-stone-800">
                Dashboard
            </h1>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <a href="/admin/orders" class="bg-white rounded-3xl p-8 shadow-lg hover:-translate-y-2 transition">
                <div class="text-5xl mb-6">📦</div>
                <h2 class="text-2xl font-bold text-stone-800 mb-3">
                    Orders
                </h2>
                <p class="text-stone-500">
                    Manage incoming customer orders.
                </p>
            </a>
            <a href="/admin/reservations" class="bg-white rounded-3xl p-8 shadow-lg hover:-translate-y-2 transition">
                <div class="text-5xl mb-6">📅</div>
                <h2 class="text-2xl font-bold text-stone-800 mb-3">
                    Reservations
                </h2>
                <p class="text-stone-500">
                    Review and organize reservations.
                </p>
            </a>
            <a href="/admin/dishes" class="bg-white rounded-3xl p-8 shadow-lg hover:-translate-y-2 transition">
                <div class="text-5xl mb-6">🍔</div>
                <h2 class="text-2xl font-bold text-stone-800 mb-3">
                    Dishes
                </h2>
                <p class="text-stone-500">
                    Update dishes and menu items.
                </p>
            </a>
            <a href="/admin/categories" class="bg-white rounded-3xl p-8 shadow-lg hover:-translate-y-2 transition">
                <div class="text-5xl mb-6">📂</div>
                <h2 class="text-2xl font-bold text-stone-800 mb-3">
                    Categories
                </h2>
                <p class="text-stone-500">
                    Organize menu structure efficiently.
                </p>
            </a>
        </div>
    </div>

@endsection