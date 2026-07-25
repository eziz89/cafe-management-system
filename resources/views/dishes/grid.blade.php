<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    
    @if($dishes->isEmpty())

        <div class="col-span-full text-center py-16">
            <h3 class="text-2xl font-bold text-gray-700 mb-2">
                No dishes found
            </h3>
            <p class="text-gray-700">
                Try another search term.
            </p>
        </div>

    @else

        @foreach($dishes as $dish)

            <div class="flex flex-col bg-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:border-orange-300 hover:-translate-y-2 hover:shadow-2xl transition duration-300">
                <div class="relative overflow-hidden rounded-t-3xl">
                    <a href="/menu/{{ $dish->id }}">
            
                        @if($dish->image)
                            <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" class="w-full h-56 object-cover hover:scale-105 transition duration-500">
                        @endif
            
                    </a>
                    
                    <div class="absolute top-1 left-4 z-30  rounded-full shadow-xl flex items-center justify-center transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1">
                        @if($dish->status === 'coming_soon')

                            <p class="text-yellow-600 bg-yellow-100 border border-yellow-600 rounded-full text-sm font-medium p-2 mt-2">
                                Coming Soon
                            </p>

                        @elseif($dish->status === 'out_of_stock')

                            <p class="text-red-600 bg-red-100 border border-red-600 rounded-full text-sm font-medium p-2 mt-2">
                                Out of Stock
                            </p>

                        @endif
                    </div>

                    @auth
        
                        @php
                            $isFavorited = auth()->user()->favorites->contains($dish->id);
                        @endphp
                    
                        <button class="favorite-btn absolute top-4 right-4 z-30 w-12 h-12 rounded-full shadow-xl flex items-center justify-center transition duration-300 hover:scale-110 active:scale-95 hover:-translate-y-1
                            {{ $isFavorited ? 'bg-red-500 text-white' : 'bg-white/90 text-gray-600' }}"
                            data-id="{{ $dish->id }}">
                            🤍
                        </button>
        
                    @endauth
                </div>

                <div class="p-6 flex flex-col flex-grow">

                    <div class="flex justify-between items-start gap-4 mb-3">

                        <a href="/menu/{{ $dish->id }}">
                            <h3 class="text-2xl font-bold text-gray-800 hover:text-orange-500 transition">
                                {{ $dish->translated_name }}
                            </h3>
                        </a>

                        <span class="text-orange-500 font-bold text-xl whitespace-nowrap">
                            ${{ number_format($dish->price, 2) }}
                        </span>

                    </div>

                    <p class="text-gray-500 leading-relaxed mb-5">
                        {{ Str::limit($dish->translated_description, 50) }}
                    </p>

                    <div class="flex justify-between items-center mb-6">

                        @if($dish->category)
                            <a href="{{ route('categories.show', $dish->category->id) }}" class="inline-flex items-center bg-orange-100 text-orange-600 text-sm font-medium rounded-full px-3 py-1 hover:bg-orange-200 transition">
                                {{ $dish->category->translated_name }}
                            </a>
                        @endif

                        @php
                            $avg = $dish->ratings->avg('rating');
                        @endphp

                        <p class="font-semibold text-gray-700 text-end ">
                            ⭐
                            {{ $avg ? number_format($avg, 1) : __('dish.new') }}
                        </p>
                    </div>
                    
                    <div class="mt-auto">
                        @if($dish->status === 'available')

                            <button class="add-to-cart-btn w-full bg-orange-500 hover:bg-orange-600 text-white rounded-2xl font-semibold py-2 hover:shadow-lg hover:shadow-orange-500/30 transition duration-300"
                                data-id="{{ $dish->id }}">
                                {{ __('cart.add_to_cart') }}
                            </button>

                        @elseif($dish->status === 'coming_soon')

                            <button
                                disabled
                                class="w-full py-2 rounded-2xl bg-yellow-100 text-yellow-700 font-semibold cursor-not-allowed">
                                Coming Soon
                            </button>

                        @else

                            <button
                                disabled
                                class="w-full py-2 rounded-2xl bg-red-100 text-red-700 font-semibold cursor-not-allowed">
                                Out of Stock
                            </button>

                        @endif
                    </div>

                </div>
            </div>

        @endforeach

    @endif
</div>

<div id="pagination-container" class="mt-10">
    {{ $dishes->appends(request()->query())->links() }}
</div>