<div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

    <div class="flex flex-wrap justify-between">
        <div class="flex items-center gap-3">
            <span class="font-semibold text-stone-700">
                Filter:
            </span>
            <button data-status="" class="order-filter px-4 py-2 rounded-full bg-orange-500 text-white">
                All
                <span id="all-count" class="ml-2 bg-white text-stone-700 text-xs font-semibold px-2 py-1 rounded-full">
                    {{ $counters['all'] }}
                </span>
            </button>
            <button data-status="pending" class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition">
                Pending
                <span id="pending-count" class="ml-2 bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['pending'] }}
                </span>

            </button>
            <button data-status="preparing" class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition">
                Preparing
                <span id="preparing-count" class="ml-2 bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['preparing'] }}
                </span>

            </button>
            <button data-status="completed" class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition">
                Completed
                <span id="completed-count" class="ml-2 bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['completed'] }}
                </span>

            </button>
            <button data-status="cancelled" class="order-filter px-4 py-2 rounded-full bg-stone-200 hover:bg-stone-300 transition">
                Cancelled
                <span id="cancelled-count" class="ml-2 bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs font-semibold">
                    {{ $counters['cancelled'] }}
                </span>

            </button>
        </div>
        
        <div>
            <input
            id="order-search"
            type="text"
            value="{{ request('search') }}"
            placeholder="🔍Search order ID or customer..."
            class="w-full md:w-96 rounded-2xl border border-stone-300
                px-5 py-3 focus:ring-2 focus:ring-orange-400
                outline-none">
        </div>
    
    </div>
</div>