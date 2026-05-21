<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b">
    <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
        <h1 class="text-3xl font-bold">
            Canteen
        </h1>
        <div class="flex gap-6 text-lg">
            <a href="/" class="{{ request()->is('/') ? 'text-orange-500 font-semibold' : 'text-black' }} hover:text-orange-500 py-2 transition">
                Home
            </a>
            <a href="/menu" class="{{ request()->is('menu') ? 'text-orange-500 font-semibold' : 'text-black' }} hover:text-orange-500 py-2 transition">
                Menu
            </a>
            <a href="/categories" class="{{ request()->is('categories*') ? 'text-orange-500 font-semibold' : 'text-black' }} hover:text-orange-500 py-2 transition">
                Categories
            </a>
            <a href="/reservations/create" class="{{ request()->is('reservations*') ? 'text-orange-500 font-semibold' : 'text-black' }} hover:text-orange-500 py-2 transition">
                Reservations
            </a>
            <a href="/cart" class="{{ request()->is('cart') ? 'text-orange-500 font-semibold' : 'text-black' }} hover:text-orange-500 py-2 transition">
                Cart
            </a>
            @auth

            <div class="relative group py-2">
                <button class="text-gray-700 hover:text-orange-500">
                    Account
                </button>

                <div class="absolute bg-white shadow-xl rounded-2xl right-0 mt-3 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition duration-200 py-3 z-50">
                    <a href="{{ route('orders.my') }}" class="{{ request()->is('my-orders') ? 'text-orange-500 font-semibold' : 'text-black' }} px-5 py-3 hover:text-orange-500 transition">
                        My Orders
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button class="w-full text-left px-5 py-3 text-red-500 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>

                </div>
            </div>

            @endauth
        </div>
    </div>
</nav>