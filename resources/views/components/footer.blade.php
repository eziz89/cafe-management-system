<footer class="bg-white border-t border-gray-300">

    <div class="max-w-7xl mx-auto px-6 lg:px-0 py-10 grid md:grid-cols-4 gap-8">

        <div>
            <h2 class="text-3xl font-bold mb-4">
                Canteen
            </h2>
            <p>
                <p class="text-gray-600 leading-relaxed font-semibold">
                    {{ __('footer.slogan') }}
                </p>
                <p class="text-gray-600 leading-relaxed">
                    {{ __('footer.footer_text') }}
                </p>
            </p>
        </div>

        <div>

            <h3 class="text-xl font-semibold mb-4">
                {{ __('footer.footer_navigation') }}
            </h3>

            <div class="flex flex-col gap-3 text-gray-500 font-semibold">
                <a href="/" class="hover:text-orange-500 transition duration-300">
                    {{ __('navigation.home') }}
                </a>
                <a href="/menu" class="hover:text-orange-500 hover:text-orange-500 transition duration-300">
                    {{ __('navigation.menu') }}
                </a>
                <a href="/categories" class="hover:text-orange-500 hover:text-orange-500 transition duration-300">
                    {{ __('navigation.categories') }}
                </a>
                <a href="/reservations/create" class="hover:text-orange-500 hover:text-orange-500 transition duration-300">
                    {{ __('navigation.reservation') }}
                </a>
            </div>
        </div>

        @auth

            <div>

                <h3 class="text-xl font-semibold mb-4">
                    {{ __('footer.footer_customer_service') }}
                </h3>

                <div class="flex flex-col gap-3 text-gray-500 font-semibold ">
                    <a href="/account" class="hover:text-orange-500 transition duration-300">
                        {{ __('navigation.account') }}
                    </a>
                    <a href="/my-orders" class="hover:text-orange-500 transition duration-300">
                        {{ __('navigation.orders') }}
                    </a>
                    <a href="/my-reservations" class="hover:text-orange-500 transition duration-300">
                        {{ __('navigation.reservations') }}
                    </a>
                    <a href="{{ route('favorites.index') }}" class="hover:text-orange-500 transition duration-300">
                        {{ __('navigation.favorites') }}
                    </a>
                </div>
            </div>

        @else

            <div>

                <h3 class="text-xl font-semibold mb-4">
                    {{ __('footer.footer_customer_service') }}
                </h3>

                <div class="flex flex-col gap-3 text-gray-500 font-semibold ">
                    <a href="/account" class="hover:text-orange-500 transition duration-300">
                        {{ __('navigation.login') }}
                    </a>
                    <a href="/my-orders" class="hover:text-orange-500 transition duration-300">
                        {{ __('register.register') }}
                    </a>
                </div>

            </div>

        @endauth

        <div>

            <h3 class="text-xl font-semibold mb-4">
                {{ __('footer.footer_information') }}
            </h3>

            <div class="flex flex-col gap-3 text-gray-500 font-semibold">
                <a href="#" class="hover:text-orange-500 transition duration-300">
                    {{ __('footer.about_us') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition duration-300">
                    {{ __('footer.privacy_policy') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition duration-300">
                    {{ __('footer.terms_and_conditions') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition duration-300">
                    {{ __('footer.delivery_information') }}
                </a>
            </div>
            
        </div>

    </div>

    <div class="border-t border-gray-300">

        <div class="flex flex-col md:flex-row justify-between items-center px-6 text-sm py-4 gap-3">
            <p class="text-gray-500">
                {{ __('footer.components') }}
            </p>

            <p class="text-gray-500">
                © 2026 Canteen. {{ __('footer.copyright') }}
            </p>
        </div>

    </div>

</footer>