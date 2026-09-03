<nav class="sticky px-4 top-0 z-50 bg-white/80 backdrop-blur-md border-b">

    <div class="max-w-7xl mx-auto py-5 flex justify-between items-center">
        
        <h1 class="text-3xl text-neutral-800 font-bold">
            Canteen
        </h1>

        <button id="mobile-menu-button" class="md:hidden text-neutral-800">

            <i data-lucide="menu" class="w-8 h-8"></i>

        </button>

        <div class="hidden md:flex gap-6 text-lg items-center">

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
                    <span id="desktop-cart-count" class="absolute -top-0 -right-5 min-w-5 h-5 px-1 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            @auth

            <div class="relative group">

                <button class="flex items-center gap-2 hover:text-orange-500 transition py-2">
                    
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
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                                {{ __('navigation.logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            
            </div>
            
            <div class="relative py-2">

                <a href="{{ route('notifications.index') }}" class="relative transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-stone-700"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.4-1.4A2 2 0 0118 14.17V11a6 6 0 10-12 0v3.17a2 2 0 01-.6 1.42L4 17h5m6 0a3 3 0 11-6 0m6 0H9"/>

                    </svg>

                    <span id="notification-count"
                        class="hidden absolute -top-3 -right-2
                            bg-red-500 text-white
                            text-xs font-bold
                            min-w-5 h-5
                            px-1
                            rounded-full
                            flex items-center justify-center">
                    </span>

                </a>

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

<div id="mobile-overlay" class="fixed inset-0 bg-black/50 z-[55] hidden md:hidden">
</div>

<div id="mobile-menu" class="fixed top-0 right-0 h-full w-72 bg-white shadow-2xl z-[60] transform translate-x-full transition-transform duration-300 md:hidden overflow-y-auto">

    <div class="p-6">

        <div class="flex items-center justify-between mb-4">

            <button id="mobile-menu-close">
                <i data-lucide="x" class="w-7 h-7"></i>
            </button>

            @auth
            
                <div class="relative py-2">

                    <a href="{{ route('notifications.index') }}">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-stone-700"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 17h5l-1.4-1.4A2 2 0 0118 14.17V11a6 6 0 10-12 0v3.17a2 2 0 01-.6 1.42L4 17h5m6 0a3 3 0 11-6 0m6 0H9"/>

                        </svg>

                        <span id="mobile-notification-count"
                              class="hidden absolute -top-0 -right-2
                                    bg-red-500 text-white
                                    text-xs font-bold
                                    min-w-5 h-5
                                    px-1
                                    rounded-full
                                    flex items-center justify-center">
                        </span>

                    </a>
            
                </div>

            @endauth

        </div>

        <div class="border-b mb-4"></div>
        
        <a href="/" class="{{ request()->is('/') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition mb-2">
            <i data-lucide="home" class="w-5 h-5"></i>
            {{ __('navigation.home') }}
        </a>

        <a href="/menu" class="{{ request()->is('menu') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition mb-2">
            <i data-lucide="utensils-crossed" class="w-5 h-5"></i>
            {{ __('navigation.menu') }}
        </a>

        <a href="/categories" class="{{ request()->is('categories*') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition mb-2">
            <i data-lucide="layout-grid" class="w-5 h-5"></i>
            {{ __('navigation.categories') }}
        </a>

        <a href="/reservations/create" class="{{ request()->is('reservations*') ? 'text-orange-500 font-semibold' : 'text-black' }} flex items-center gap-2 hover:text-orange-500 py-2 transition mb-2">
            <i data-lucide="calendar-check" class="w-5 h-5"></i>
            {{ __('navigation.reservation') }}
        </a>

        <a href="/cart" class="{{ request()->is('cart') ? 'text-orange-500 font-semibold' : 'text-black' }} cart-link relative flex items-center gap-2 hover:text-orange-500 py-2 transition mb-2">
            <i data-lucide="shopping-cart" class="w-5 h-5"></i>
            {{ __('navigation.cart') }}

            @if($cartCount > 0)
                <span id="mobile-cart-count" class="absolute -top-0 sm:-right-5 -left-2 min-w-5 h-5 px-1 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center">
                    {{ $cartCount }}
                </span>
            @endif
        </a>

        @auth
            
        <div class="mt-4">
            <button id="mobile-account-button" class="w-full flex justify-between items-center hover:text-orange-500">
                    
                <div class="flex items-center">
                    <i data-lucide="user" class="w-5 h-5"></i>
                    <span class="pl-2">
                        {{ __('navigation.account') }}
                    </span>
                </div>
                
                <i data-lucide="chevron-down"
                   class="w-5 h-5 transition"
                   id="account-arrow">
                </i>
            </button>
            
            <div id="mobile-account-menu" class="hidden mt-3 ml-4 space-y-3 text-base">
                <a href="{{ route('account') }}" class="{{ request()->is('account') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block py-3 hover:bg-orange-50 hover:text-orange-500 transition">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    {{ __('navigation.dashboard') }}
                </a>
                <a href="{{ route('orders.my') }}" class="{{ request()->is('my-orders') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                    <i data-lucide="receipt-text" class="w-5 h-5"></i>
                    {{ __('navigation.orders') }}
                </a>
                <a href="{{ route('reservations.my') }}" class="{{ request()->is('my-reservations') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                    <i data-lucide="calendar-check" class="w-5 h-5"></i>
                    {{ __('navigation.reservations') }}
                </a>
                
                <a href="#" class="{{ request()->is('my-reviews') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
                    <i data-lucide="star" class="w-5 h-5"></i>
                    {{ __('navigation.reviews') }}
                </a>
                
                <a href="{{ route('favorites.index') }}" class="{{ request()->is('favorites') ? 'text-orange-500' : 'text-gray-700' }} flex items-center gap-2 block py-3 text-gray-700 hover:bg-orange-50 hover:text-orange-500 transition">
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
            
                    <button type="submit" class="w-full flex items-center gap-2 text-left py-3 text-red-500 hover:bg-red-50 transition">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        {{ __('navigation.logout') }}
                    </button>
                </form>
            </div>
        </div>
        
        @else

        <a href="{{ route('login') }}" class="flex items-center gap-1 text-orange-500 hover:text-orange-600 py-2 transition">
            <i data-lucide="log-in" class="w-5 h-5"></i>
            {{ __('navigation.login') }}
        </a>

        <div class="border-t pt-5 mt-5">

            <p class="text-xs uppercase tracking-widest text-gray-400 mb-3">
                {{ __('language.language') }}
            </p>

            <div class="space-y-2">

                @foreach($languages as $code => $name)

                    <a href="{{ route('language.switch', $code) }}"
                       class="block rounded-xl px-3 py-2
                       {{ app()->getLocale() == $code ? 'bg-orange-100 text-orange-500 font-semibold' : 'hover:bg-orange-50' }}">

                        {{ $name }}

                    </a>

                @endforeach

            </div>

        </div>
 
        @endauth

    </div>

</div>