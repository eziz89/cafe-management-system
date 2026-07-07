<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    <table class="w-full">
        <thead class="bg-stone-100">
            <tr>
                <th class="px-6 py-4 text-left text-sm font-semibold text-stone-600">
                    Dish
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-stone-600">
                    Category
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-stone-600">
                    Price
                </th>
                <th class="px-6 py-4 text-center text-sm font-semibold text-stone-600">
                    Status
                </th>
                <th class="px-6 py-4 text-left text-sm font-semibold text-stone-600">
                    Actions
                </th>
            </tr>
        </thead>

        <tbody>

            @forelse($dishes as $dish)

                <tr class="border-b border-gray-400 hover:bg-orange-50 hover:shadow-sm transition">

                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">
                            <img
                                src="{{ asset('storage/'.$dish->image) }}"
                                class="w-18 h-18 rounded-2xl object-cover border border-stone-200 shadow-sm">
                            <div>
                                <p class="font-bold text-stone-800">
                                    {{ $dish->name }}
                                </p>
                                <p class="text-sm text-stone-500">
                                    #{{ $dish->id }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-5">
                        @if($dish->category)
                                <span class="inline-flex items-center bg-orange-100 text-orange-600 text-sm font-medium rounded-full px-3 py-1 hover:bg-orange-200 transition">
                                    {{ $dish->category->translated_name }}
                                </span>
                            @endif
                    </td>

                    <td class="px-6 py-5 font-semibold text-lg">
                        ${{ number_format($dish->price,2) }}
                    </td>

                    <td>
                        @if($dish->status === 'available')

                            <span id="dish-status-badge-{{ $dish->id }}"
                                class="inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                🟢 Available
                                
                            </span>

                        @elseif($dish->status === 'coming_soon')

                            <span id="dish-status-badge-{{ $dish->id }}"
                                class="inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                🟡 Coming Soon

                            </span>

                        @elseif($dish->status === 'out_of_stock')

                            <span id="dish-status-badge-{{ $dish->id }}"
                                class="inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                🔴 Out of Stock

                            </span>

                        @endif
                        
                        <form method="POST"
                            action="{{ route('admin.dishes.status', $dish) }}"
                            class="dish-status-form mt-3"
                            data-dish-id="{{ $dish->id }}">

                            @csrf
                            @method('PATCH')

                            <select name="status"
                                class="dish-status-select text-sm border rounded-lg px-2 py-1">

                                <option value="available"
                                    @selected($dish->status === 'available')>
                                    Available
                                </option>

                                <option value="coming_soon"
                                    @selected($dish->status === 'coming_soon')>
                                    Coming Soon
                                </option>

                                <option value="out_of_stock"
                                    @selected($dish->status === 'out_of_stock')>
                                    Out of Stock
                                </option>

                            </select>

                        </form>
                    </td>

                    <td class="px-6 py-5">
                        <div class="flex justify-center gap-3">
                            <a
                                href="{{ route('admin.dishes.edit', $dish) }}"
                                class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">
                                ✏ Edit
                            </a>
                    
                            <form
                                action="/admin/dishes/{{ $dish->id }}"
                                method="POST"
                                onsubmit="return confirm('Delete this dish?')">
                    
                                @csrf
                                @method('DELETE')
                    
                                <button class="px-4 py-2 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition">
                                    🗑 Delete
                                </button>
                    
                            </form>
                    
                        </div>
                    
                    </td>
                </tr>
                
            @empty

                <tr>
                    <td colspan="5" class="py-16 text-center">
                        <div class="text-5xl mb-4">
                            🔍
                        </div>
                        <h3 class="text-2xl front-bold mb-2">
                            No dishes found
                        </h3>
                        <p class="text-stone-500">
                            Try another search term
                        </p>
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

</div>

<div class="mt-6 mx-6">
    {{ $dishes->links() }}
</div>