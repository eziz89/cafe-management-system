<div id="menu-info">

    <h2 class="text-4xl font-bold text-gray-900 mb-2">
        {{ __('menu.all_dishes') }}
    </h2>

    @if(request('category'))

        @php
            $selectedCategory = $categories->firstWhere('id', request('category'));
        @endphp

        <p class="text-orange-500 font-medium mt-2">
            {{ __('category.category') }}:
            {{ $selectedCategory?->translated_name }}
        </p>

    @endif

    <p class="text-gray-500">
        {{ __('menu.showing') }}
        {{ $dishes->total() }}
        {{ __('menu.delicious_items') }}
    </p>

</div>