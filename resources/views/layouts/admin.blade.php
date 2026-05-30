<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Admin Panel</title>

</head>

<body class="bg-stone-100 min-h-screen">

    <nav class="bg-white shadow-md border-b border-stone-200 mb-12">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-stone-800">
                Admin Panel
            </h1>
            <div class="flex items-center gap-6">
                <a href="/admin" class="{{ request()->is('admin') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                    Dashboard
                </a>
                <a href="/admin/orders" class="{{ request()->is('admin/orders') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                    Orders
                </a>
                <a href="/admin/reservations" class="{{ request()->is('admin/reservations') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                    Reservations
                </a>
                <a href="/admin/dishes" class="{{ request()->is('admin/dishes') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                    Dishes
                </a>
                <a href="/admin/categories" class="{{ request()->is('admin/categories') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                    Categories
                </a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>