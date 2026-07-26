<footer class="border-t border-gray-300">

    <div class="max-w-7xl mx-auto py-8 grid md:grid-cols-4 gap-16">

        <div>
            <h2 class="text-3xl font-bold mb-4">
                Canteen
            </h2>
            <p>
                <div class="text-gray-600 leading-relaxed font-semibold">
                    {{ __('footer.slogan') }}
                </div>
                <div class="text-gray-600 leading-relaxed">
                    {{ __('footer.footer_text') }}
                </div>
            </p>
        </div>

        <div>

            <h3 class="text-xl font-semibold mb-4">
                {{ __('footer.footer_navigation') }}
            </h3>

            <div class="flex flex-col gap-3 text-gray-500 font-semibold">
                <a href="/" class="hover:text-orange-500 transition">
                    {{ __('navigation.home') }}
                </a>
                <a href="/menu" class="hover:text-orange-500hover:text-orange-500 transition">
                    {{ __('navigation.menu') }}
                </a>
                <a href="/categories" class="hover:text-orange-500hover:text-orange-500 transition">
                    {{ __('navigation.categories') }}
                </a>
                <a href="/reservations/create" class="hover:text-orange-500hover:text-orange-500 transition">
                    {{ __('navigation.reservation') }}
                </a>
            </div>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-4">
                {{ __('footer.footer_customer_service') }}
            </h3>
            <div class="flex flex-col gap-3 text-gray-500 font-semibold ">
                <a href="/account" class="hover:text-orange-500 transition">
                    {{ __('navigation.account') }}
                </a>
                <a href="/my-orders" class="hover:text-orange-500 transition">
                    {{ __('navigation.orders') }}
                </a>
                <a href="/my-reservations" class="hover:text-orange-500 transition">
                    {{ __('navigation.reservations') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition">
                    {{ __('navigation.favorites') }}
                </a>
            </div>
        </div>

        <div>

            <h3 class="text-xl font-semibold mb-4">
                {{ __('footer.footer_information') }}
            </h3>

            <div class="flex flex-col gap-3 text-gray-500 font-semibold">
                <a href="#" class="hover:text-orange-500 transition">
                    {{ __('footer.about_us') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition">
                    {{ __('footer.privacy_policy') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition">
                    {{ __('footer.terms_and_conditions') }}
                </a>
                <a href="#" class="hover:text-orange-500 transition">
                    {{ __('footer.delivery_information') }}
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-300">
        <div class="max-w-7xl mx-auto text-sm py-4 flex justify-between items-center">
            <p class="text-gray-500">
                {{ __('footer.components') }}
            </p>

            <p class="text-gray-500">
                © 2026 Canteen. {{ __('footer.copyright') }}
            </p>
        </div>
    </div>

</footer>