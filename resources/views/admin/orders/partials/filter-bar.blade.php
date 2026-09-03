<div class="bg-white rounded-3xl shadow-lg p-4 sm:p-6 mb-8">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        {{-- Status Filters --}}
        <div class="flex flex-wrap items-center gap-2">

            <button
                data-status=""
                class="order-filter px-3 sm:px-4 py-2 rounded-full bg-orange-500 text-white text-sm sm:text-base">

                Ählisi

                <span
                    id="all-count"
                    class="ml-1 sm:ml-2 bg-white text-stone-700 text-xs font-semibold px-2 py-1 rounded-full">
                    {{ $counters['all'] }}
                </span>

            </button>

            <button
                data-status="pending"
                class="order-filter px-3 sm:px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition text-sm sm:text-base">

                Garaşylýanlar

                <span
                    id="pending-count"
                    class="ml-1 sm:ml-2 bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['pending'] }}
                </span>

            </button>

            <button
                data-status="preparing"
                class="order-filter px-3 sm:px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition text-sm sm:text-base">

                Taýýarlyk görýänler

                <span
                    id="preparing-count"
                    class="ml-1 sm:ml-2 bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['preparing'] }}
                </span>

            </button>

            <button
                data-status="completed"
                class="order-filter px-3 sm:px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition text-sm sm:text-base">

                Tamamlananlar

                <span
                    id="completed-count"
                    class="ml-1 sm:ml-2 bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['completed'] }}
                </span>

            </button>

            <button
                data-status="cancelled"
                class="order-filter px-3 sm:px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition text-sm sm:text-base">

                Ýatyrylanlar

                <span
                    id="cancelled-count"
                    class="ml-1 sm:ml-2 bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['cancelled'] }}
                </span>

            </button>

        </div>

        {{-- Search + Reset --}}
        <div class="flex flex-row gap-2 w-full lg:w-auto">

            <input
                id="order-search"
                type="text"
                value="{{ request('search') }}"
                placeholder="🔍 Sargyt belgisi ýa-da müşderi boýunça gözläň..."
                class="w-full lg:w-96 rounded-2xl border border-stone-300
                    px-5 py-3 focus:ring-2 focus:ring-orange-400
                    focus:outline-none">

            <button
                id="reset-filters"
                type="button"
                class="px-4 py-3 rounded-2xl border border-stone-300
                       hover:bg-stone-100 transition whitespace-nowrap">

                <div class="flex items-center justify-center gap-2">

                    <i data-lucide="circle-x" class="w-5 h-5"></i>

                    Täzelemek

                </div>

            </button>

        </div>

    </div>

</div>