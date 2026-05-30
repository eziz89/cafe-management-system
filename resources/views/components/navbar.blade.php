<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b">
    <div class="max-w-7xl mx-auto py-5 flex justify-between items-center">
        <h1 class="text-3xl text-neutral-800 font-bold">
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
            <a href="/cart" class="{{ request()->is('cart') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                Cart
            </a>
            
            @auth

            <div class="relative group">

                <button class="text-gray-700 hover:text-orange-500 transition font-medium py-2">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    Account 
                </button>

                <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="py-3">
                        <a href="{{ route('account') }}" class="{{ request()->is('account') ? 'text-orange-500' : 'text-gray-700' }} block px-5 py-3 hover:bg-orange-50 hover:text-orange-500 transition">
                            Dashboard
                        </a>
                        <a href="{{ route('orders.my') }}"
                           class="{{ request()->is('my-orders') ? 'text-orange-500' : 'text-gray-700' }} block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            My Orders
                        </a>
                        <a href="{{ route('reservations.my') }}" class="{{ request()->is('my-reservations') ? 'text-orange-500' : 'text-gray-700' }} block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            My Reservations
                        </a>
                        <a href="#" class="{{ request()->is('my-reviews') ? 'text-orange-500' : 'text-gray-700' }} block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            My Reviews
                        </a>

                        <div class="border-t my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
            
                            <button type="submit" class="w-full text-left px-5 py-3 text-red-500 hover:bg-red-50 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            
            </div>

            @else

            <a href="{{ route('login') }}" class="flex items-center gap-2 text-orange-500 hover:text-orange-600 py-2 transition">
                <i data-lucide="log-in" class="w-5 h-5"></i>
                Login
            </a>

            @endauth

        </div>
    </div>
</nav>