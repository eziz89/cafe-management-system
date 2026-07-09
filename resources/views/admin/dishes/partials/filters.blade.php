<div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1">
            <input
                id="dish-search"
                name="search"
                value="{{ request('search') }}"
                type="text"
                placeholder="🔍 Search dishes..."
                class="w-full px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
        </div>

        @if(!isset($hideCategory))

            <select id="category-filter" class="px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
    
                <option value="">
                    All Categories
                </option>
    
                @foreach($categories as $category)
    
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
    
                @endforeach
    
            </select>

        @endif

        <select id="status-filter" class="px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
    
            <option value="">All Statuses</option>
    
            <option value="available">
                🟢 Available
            </option>
    
            <option value="coming_soon">
                🟡 Coming Soon
            </option>
    
            <option value="out_of_stock">
                🔴 Out of Stock
            </option>
    
        </select>
    
        <select id="sort-filter" class="px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
    
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
            <option value="price_desc">Price ↑</option>
            <option value="price_asc">Price ↓</option>
            <option value="name_asc">Name A–Z</option>
            <option value="name_desc">Name Z–A</option>
    
        </select>

        <button type="button" id="reset-filters" class="px-4 py-3 rounded-2xl border border-stone-300 hover:bg-stone-100 transition">
            
            <div class="flex items-center gap-2">
                <i data-lucide="circle-x" class="w-5 h-5"></i>
                Reset
            </div>
            
        </button>

    </div>

</div>