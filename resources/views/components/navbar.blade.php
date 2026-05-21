<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
        <h1 class="text-3xl font-bold">
            Canteen
        </h1>
        <div class="flex gap-6 text-lg">
            <a href="/" class="hover:text-orange-500 transition">
                Home
            </a>
            <a href="/menu" class="hover:text-orange-500 transition">
                Menu
            </a>
            <a href="/categories" class="hover:text-orange-500 transition">
                Categories
            </a>
            <a href="/reservations/create" class="hover:text-orange-500 transition">
                Reservations
            </a>
            <a href="/cart" class="hover:text-orange-500 transition">
                Cart
            </a>
            @auth

            <div class="relative group">
                <button class="text-gray-700">
                    Account
                </button>

                <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-xl p-4">
                    <a href="{{ route('orders.my') }}" class="block py-2 hover:text-orange-500">
                        My Orders
                    </a>
                    <a href="/logout" class="block py-2 text-red-500">
                        Logout
                    </a>
                </div>
            </div>
            
            @endauth
        </div>
    </div>
</nav>