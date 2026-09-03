<div class="flex flex-wrap">

    @if(request('search'))
        <a href="{{ route('menu.index', request()->except('search')) }}"
            class="flex items-center gap-2 bg-orange-100 text-orange-600 px-4 py-2 rounded-full hover:bg-orange-200 transition mb-4 mx-3">

            Search: {{ request('search') }}

            <span class="font-bold">✕</span>
        </a>
    @endif

    @if(request('category'))
        @php
            $selectedCategory = $categories->firstWhere('id', request('category'));
        @endphp

        <a href="{{ route('menu.index', request()->except('category')) }}"
            class="flex items-center gap-2 bg-blue-100 text-blue-600 px-4 py-2 rounded-full hover:bg-blue-200 transition mb-4 mx-3">
            
            {{ $selectedCategory?->translated_name }}

            <span class="font-bold">✕</span>
        </a>
    @endif

    @if(request('sort') && request('sort') !== 'newest')
        @php
            $sortLabels = [
                'price_low' => 'Price: Low → High',
                'price_high' => 'Price: High → Low',
                'top_rated' => 'Top Rated'    
            ];
        @endphp
        
        <a href="{{ route('menu.index', request()->except('sort')) }}"
            class="flex items-center gap-2 bg-green-100 text-green-600 px-4 py-2 rounded-full hover:bg-green-200 transition mb-4 mx-3">
        
            {{ $sortLabels[request('sort')] ?? 'Sort' }}
        
            <span class="font-bold">✕</span>
        </a>
    @endif
        
</div>