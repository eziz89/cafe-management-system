<div class="bg-white rounded-3xl shadow-lg p-6 mb-8">

    <div class="flex flex-col md:flex-row gap-4">
        
        <div class="relative flex-1">

            <i data-lucide="search"
               class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-stone-400">
            </i>
                
            <input
                id="dish-search"
                name="search"
                value="{{ request('search') }}"
                type="text"
                placeholder="Tagamlary gözlemek..."
                class="w-full pl-12 pr-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
        </div>

        @if(!isset($hideCategory))

            <select id="category-filter" class="px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
    
                <option value="">
                    Ähli kategoriýalar
                </option>
    
                @foreach($categories as $category)
    
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
    
                @endforeach
    
            </select>

        @endif

        <select id="status-filter" class="px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
    
            <option value="">Ähli ýagdaýlar</option>
    
            <option value="available">
                Elýeterli
            </option>
    
            <option value="coming_soon">
                Ýakynda
            </option>
    
            <option value="out_of_stock">
                Ambarda ýok
            </option>
    
        </select>
    
        <select id="sort-filter" class="px-5 py-3 rounded-2xl border border-stone-200 focus:outline-none focus:ring-2 focus:ring-orange-300">
    
            <option value="newest">Iň täzeler</option>
            <option value="oldest">Iň köneler</option>
            <option value="price_desc">Baha ↑</option>
            <option value="price_asc">Baha ↓</option>
            <option value="name_asc">Ady A–Z</option>
            <option value="name_desc">Ady Z–A</option>
    
        </select>

        <button type="button" id="reset-filters" class="px-4 py-3 rounded-2xl border border-stone-300 hover:bg-stone-100 transition">
            
            <div class="flex items-center justify-center gap-2">
                <i data-lucide="circle-x" class="w-5 h-5"></i>
                Täzele
            </div>
            
        </button>

    </div>

</div>