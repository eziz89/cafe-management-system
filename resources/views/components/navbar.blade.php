<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b">
    <div class="max-w-7xl mx-auto py-5 flex justify-between items-center">
        <h1 class="text-3xl text-neutral-800 font-bold">
            Canteen
        </h1>

        <div class="flex gap-6 text-lg">
            <a href="/" class="{{ request()->is('/') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition">
                <i data-lucide="home" class="w-5 h-5"></i>
                {{ __('navigation.home') }}
            </a>
            <a href="/menu" class="{{ request()->is('menu') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition">
                <i data-lucide="utensils-crossed" class="w-5 h-5"></i>
                {{ __('navigation.menu') }}
            </a>
            <a href="/categories" class="{{ request()->is('categories*') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition">
                <i data-lucide="layout-grid" class="w-5 h-5"></i>
                {{ __('navigation.categories') }}
            </a>
            <a href="/reservations/create" class="{{ request()->is('reservations*') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition">
                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                {{ __('navigation.reservation') }}
            </a>
            <a href="/cart" class="{{ request()->is('cart') ? 'text-orange-500 font-semibold' : 'text-black' }} cart-link relative flex items-center gap-2 hover:text-orange-500 py-2 transition">
                <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                {{ __('navigation.cart') }}

                @if($cartCount > 0)
                    <span id="cart-count" class="absolute -top-0 -right-5 min-w-5 h-5 px-1 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth

            <div class="relative group">

                <button class="flex items-center gap-2 text-gray-700 hover:text-orange-500 transition font-medium py-2">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    {{ __('navigation.account') }} 
                </button>

                <div class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="py-3">
                        <a href="{{ route('account') }}" class="{{ request()->is('account') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block px-5 py-3 hover:bg-orange-50 hover:text-orange-500 transition">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            {{ __('navigation.dashboard') }}
                        </a>
                        <a href="{{ route('orders.my') }}" class="{{ request()->is('my-orders') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            <i data-lucide="receipt-text" class="w-5 h-5"></i>
                            {{ __('navigation.orders') }}
                        </a>
                        <a href="{{ route('reservations.my') }}" class="{{ request()->is('my-reservations') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            <i data-lucide="calendar-check" class="w-5 h-5"></i>
                            {{ __('navigation.reservations') }}
                        </a>
                        <a href="#" class="{{ request()->is('my-reviews') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            <i data-lucide="star" class="w-5 h-5"></i>
                            {{ __('navigation.reviews') }}
                        </a>
                        <a href="{{ route('favorites.index') }}" class="{{ request()->is('favorites') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block px-5 py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                            Favorites
                        </a>
                        <div class="flex items-center text-center text-neutral-800">
                            <a href="{{ route('language.switch', 'tk') }}" class="flex items-center gap-2 block px-5 py-3 hover:bg-orange-50 hover:text-orange-500 transition">
                                TKM
                            </a>
                            <a href="{{ route('language.switch', 'en') }}" class="flex items-center gap-2 block px-5 py-3 hover:bg-orange-50 hover:text-orange-500 transition">
                                ENG
                            </a>
                            <a href="{{ route('language.switch', 'ru') }}" class="flex items-center gap-2 block px-5 py-3 hover:bg-orange-50 hover:text-orange-500 transition">
                                RUS
                            </a>
                        </div>

                        <div class="border-t my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
            
                            <button type="submit" class="w-full flex items-center gap-2 text-left px-5 py-3 text-red-500 hover:bg-red-50 transition">
                                <i data-lucide="user" class="w-5 h-5"></i>
                                {{ __('navigation.logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            
            </div>

            @else

            <a href="{{ route('login') }}" class="flex items-center gap-1 text-orange-500 hover:text-orange-600 py-2 transition">
                <i data-lucide="log-in" class="w-5 h-5"></i>
                {{ __('navigation.login') }}
            </a>
            
            

            <div class="relative group">

                <div class="px-2 py-3 border-b border-gray-400">
                    <p class="text-xs uppercase tracking-wider text-gray-400 x-transition.scale">
                        {{ __('language.language') }}
                    </p>
                </div>
                
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible shadow-lg border border-gray-100 x-transition.scale">

                    @php
                    $currentLocale = app()->getLocale();
        
                    $languages = [
                        'tk' => 'Türkmen',
                        'ru' => 'Русский',
                        'en' => 'English',
                    ];
                    @endphp
                
                    @foreach($languages as $code => $name)
                
                        <a href="{{ route('language.switch', $code) }}" class="flex items-center justify-between px-4 py-3 rounded-2xl hover:bg-orange-50 x-transition.scale {{ app()->getLocale() == $code ? 'text-orange-500 font-semibold bg-orange-50' : 'text-gray-700' }}">
                            <span>{{ $name }}</span>
                
                            @if(app()->getLocale() == $code)
                                *
                            @endif
                        </a>
                
                    @endforeach

                </div>
                
            </div>

            @endauth

        </div>
    </div>
</nav>