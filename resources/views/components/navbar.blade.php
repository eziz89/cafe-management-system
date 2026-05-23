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

            <div class="relative group">

                <button class="text-gray-700 hover:text-orange-500 transition font-medium py-2">
                    Account
                </button>

                <div class="absolute right-0 mt-4 w-56 bg-white rounded-lg shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="py-3">
                        <a href="{{ route('orders.my') }}"
                           class="block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            My Orders
                        </a>
                        <a href="{{ route('reservations.my') }}"
                           class="block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            My Reservations
                        </a>
                        <div class="border-t my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
            
                            <button type="submit"
                                    class="w-full text-left px-5 py-3 text-red-500 hover:bg-red-50 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            
            </div>

            @endauth
        </div>
    </div>
</nav>