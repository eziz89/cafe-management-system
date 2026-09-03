<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite([
        'resources/css/app.css',
        'resources/js/admin.js',
    ])

    <title>Admin Panel</title>

    <style>
        
        .scrollbar-thin::-webkit-scrollbar{
            width:6px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb{
            background:#d6d3d1;
            border-radius:9999px;
        }

    </style>
    
</head>

<body class="bg-stone-100 min-h-screen">

    <nav class="sticky top-0 z-50 bg-white shadow-md border-b border-stone-200 mb-8">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-5">
        
            <div class="flex justify-between items-center">
        
                {{-- Logo / Title --}}
                <h1 class="text-xl sm:text-2xl font-bold text-stone-800">
                    Admin Panel
                </h1>
        
                {{-- Desktop Navigation --}}
                <div class="hidden md:flex items-center gap-6">
        
                    <a href="/admin"
                       class="{{ request()->is('admin') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                        Dashboard
                    </a>
        
                    <a href="/admin/orders"
                       class="{{ request()->is('admin/orders') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                        Orders
                    </a>
        
                    <a href="/admin/reservations"
                       class="{{ request()->is('admin/reservations') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                        Reservations
                    </a>
        
                    <a href="/admin/dishes"
                       class="{{ request()->is('admin/dishes') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                        Dishes
                    </a>
        
                    <a href="/admin/categories"
                       class="{{ request()->is('admin/categories') ? 'text-orange-500' : 'text-neutral-800' }} hover:text-orange-500 transition">
                        Categories
                    </a>
        
                </div>
        
                {{-- Mobile Menu Button --}}
                <button
                    id="admin-menu-btn"
                    type="button"
                    class="md:hidden p-2 rounded-xl hover:bg-stone-100 transition"
                    aria-label="Open navigation">
        
                    <i data-lucide="menu" class="w-6 h-6"></i>
        
                </button>
        
            </div>
        
            {{-- Mobile Navigation --}}
            <div id="admin-mobile-menu" class="hidden md:hidden pt-4">
        
                <div class="flex flex-col gap-2 border-t border-stone-200 pt-4">
        
                    <a href="/admin"
                       class="px-4 py-3 rounded-xl
                       {{ request()->is('admin') ? 'bg-orange-50 text-orange-500' : 'text-neutral-800' }}
                       hover:bg-orange-50 hover:text-orange-500 transition">
                        Dashboard
                    </a>
        
                    <a href="/admin/orders"
                       class="px-4 py-3 rounded-xl
                       {{ request()->is('admin/orders') ? 'bg-orange-50 text-orange-500' : 'text-neutral-800' }}
                       hover:bg-orange-50 hover:text-orange-500 transition">
                        Orders
                    </a>
        
                    <a href="/admin/reservations"
                       class="px-4 py-3 rounded-xl
                       {{ request()->is('admin/reservations') ? 'bg-orange-50 text-orange-500' : 'text-neutral-800' }}
                       hover:bg-orange-50 hover:text-orange-500 transition">
                        Reservations
                    </a>
        
                    <a href="/admin/dishes"
                       class="px-4 py-3 rounded-xl
                       {{ request()->is('admin/dishes') ? 'bg-orange-50 text-orange-500' : 'text-neutral-800' }}
                       hover:bg-orange-50 hover:text-orange-500 transition">
                        Dishes
                    </a>
        
                    <a href="/admin/categories"
                       class="px-4 py-3 rounded-xl
                       {{ request()->is('admin/categories') ? 'bg-orange-50 text-orange-500' : 'text-neutral-800' }}
                       hover:bg-orange-50 hover:text-orange-500 transition">
                        Categories
                    </a>
        
                </div>
        
            </div>
        
        </div>
        
    </nav>

    <main>
        @yield('content')
    </main>

    @if(session('success'))
        <div id="flash-message"
             class="fixed top-6 right-6 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

</body>
</html>
 