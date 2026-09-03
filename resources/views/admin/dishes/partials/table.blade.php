<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    {{-- Desktop Table --}}
    <div class="hidden md:block">

        <table class="w-full">

            <thead class="bg-stone-100">
                <tr>
                    <th class="px-6 py-4 text-left">Tagam</th>

                    @if(!($hideCategory ?? false))
                        <th class="px-6 py-4 text-left">Kategoriýa</th>
                    @endif

                    <th class="px-6 py-4 text-left">Baha</th>
                    <th class="px-6 py-4 text-center">Ýagdaý</th>
                    <th class="px-6 py-4">Hereketler</th>
                </tr>
            </thead>


            <tbody>

            @forelse($dishes as $dish)

                <tr class="border-b border-stone-200 hover:bg-orange-50 transition">

                    <td class="px-6 py-5">
                        <div class="flex items-center gap-4">

                            <img
                                src="{{ asset('storage/'.$dish->image) }}"
                                class="w-18 h-18 rounded-2xl object-cover">

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


                    @if(!($hideCategory ?? false))

                    <td class="px-6 py-5">

                        @if($dish->category)

                            <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-sm">
                                {{ $dish->category->translated_name }}
                            </span>

                        @endif

                    </td>

                    @endif


                    <td class="px-6 py-5 font-semibold">
                        {{ number_format($dish->price,2) }} TMT
                    </td>

                    <td class="text-center">
                        @if($dish->status === 'available')

                            <span data-dish-id="{{ $dish->id }}"
                                class="dish-status-badge inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                <div class="flex items-center gap-1">
                                    <i data-lucide="circle-check" class="w-4 h-4"></i>
                                    Elýeterli
                                </div>
                                
                            </span>

                        @elseif($dish->status === 'coming_soon')

                            <span data-dish-id="{{ $dish->id }}"
                                class="dish-status-badge inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                <div class="flex items-center gap-1">
                                    <i data-lucide="clock" class="w-4 h-4"></i>
                                    Ýakynda
                                </div>

                            </span>

                        @elseif($dish->status === 'out_of_stock')

                            <span data-dish-id="{{ $dish->id }}"
                                class="dish-status-badge inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                <div class="flex items-center gap-1">
                                    <i data-lucide="circle-x" class="w-4 h-4"></i>
                                    Ambarda ýok
                                </div>

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
                                    Elýeterli
                                </option>

                                <option value="coming_soon"
                                    @selected($dish->status === 'coming_soon')>
                                    Ýakynda
                                </option>

                                <option value="out_of_stock"
                                    @selected($dish->status === 'out_of_stock')>
                                    Ambarda ýok
                                </option>

                            </select>

                        </form>
                    </td>

                    <td class="px-6 py-5">

                        <div class="flex justify-center gap-3">

                            <a
                                href="{{ route('admin.dishes.edit', $dish) }}"
                                class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">
                                
                                <span class="flex items-center gap-1">
                                    <i data-lucide="pencil" class="w-4 h-4"></i>
                                    Üýtgetmek
                                </span>

                            </a>
                    
                            <form
                                action="/admin/dishes/{{ $dish->id }}"
                                method="POST"
                                onsubmit="return confirm('Delete this dish?')">
                    
                                @csrf
                                @method('DELETE')
                    
                                <button class="px-4 py-2 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition">
                                    
                                    <div class="flex items-center gap-1">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        Pozmak
                                    </div>

                                </button>
                    
                            </form>
                    
                        </div>
                    
                    </td>

                </tr>


            @empty

                <tr>
                    <td colspan="5" class="py-16 text-center">
                        Hiç hili tagam tapylmady
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>



    {{-- Mobile Cards --}}
    <div class="md:hidden p-4 space-y-4">

        @forelse($dishes as $dish)

            <div class="bg-stone-50 rounded-3xl p-4 shadow-sm border border-stone-200">

                <div class="flex gap-4">

                    <img
                        src="{{ asset('storage/'.$dish->image) }}"
                        class="w-20 h-20 rounded-2xl object-cover">


                    <div class="flex-1">

                        <h3 class="font-bold text-lg text-stone-800">
                            {{ $dish->name }}
                        </h3>


                        <p class="text-sm text-stone-500">
                            #{{ $dish->id }}
                        </p>


                        <p class="text-orange-500 font-bold mt-1">
                            {{ number_format($dish->price,2) }} TMT
                        </p>

                    </div>

                </div>

                <div class="mt-4 flex justify-between items-center">

                    <td class="text-center">
                        @if($dish->status === 'available')

                            <span data-dish-id="{{ $dish->id }}"
                                class="dish-status-badge inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                <div class="flex items-center gap-1">
                                    <i data-lucide="circle-check" class="w-4 h-4"></i>
                                    Elýeterli
                                </div>
                                
                            </span>

                        @elseif($dish->status === 'coming_soon')

                            <span data-dish-id="{{ $dish->id }}"
                                class="dish-status-badge inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                <div class="flex items-center gap-1">
                                    <i data-lucide="circle-x" class="w-4 h-4"></i>
                                    Ýakynda
                                </div>

                            </span>

                        @elseif($dish->status === 'out_of_stock')

                            <span data-dish-id="{{ $dish->id }}"
                                class="dish-status-badge inline-flex items-center px-3 py-1 rounded-full
                                @if($dish->status === 'available')
                                    bg-green-100 text-green-700
                                @elseif($dish->status === 'coming_soon')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-red-100 text-red-700
                                @endif">

                                <div class="flex items-center gap-1">
                                    <i data-lucide="circle-x" class="w-4 h-4"></i>
                                    Ambarda ýok
                                </div>

                            </span>

                        @endif
                        
                    </td>

                    @if($dish->category)
                        @if(!($hideCategory ?? false))
                            <span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-full text-xs">
                                {{ $dish->category->translated_name }}
                            </span>
                        @endif

                    @endif

                </div>

                <div class="mt-4">

                    <form method="POST"
                        action="{{ route('admin.dishes.status',$dish) }}"
                        class="dish-status-form"
                        data-dish-id="{{ $dish->id }}">

                        @csrf
                        @method('PATCH')

                        <select name="status" class="dish-status-select w-full border rounded-xl px-3 py-2">

                            <option value="available"
                                @selected($dish->status==='available')>
                                Elýeterli
                            </option>

                            <option value="coming_soon"
                                @selected($dish->status==='coming_soon')>
                                Ýakynda
                            </option>

                            <option value="out_of_stock"
                                @selected($dish->status==='out_of_stock')>
                                Ambarda ýok
                            </option>

                        </select>

                    </form>

                </div>

                <div class="flex gap-3 mt-4">

                    <a href="{{ route('admin.dishes.edit',$dish) }}"
                       class="w-1/2 bg-yellow-100 text-yellow-700 py-2 rounded-xl text-center font-semibold">

                        <span class="flex items-center gap-1 pl-6">
                            <i data-lucide="pencil" class="w-4 h-4"></i>
                            Üýtgetmek
                        </span>

                    </a>


                    <form
                        action="/admin/dishes/{{ $dish->id }}"
                        method="POST"
                        class="w-1/2"
                        onsubmit="return confirm('Delete this dish?')">

                        @csrf
                        @method('DELETE')

                        <button class="w-full bg-red-100 text-red-600 py-2 rounded-xl font-semibold">

                            <span class="flex items-center gap-1 pl-10">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                Pozmak
                            </span>

                        </button>

                    </form>

                </div>


            </div>


        @empty

            <div class="text-center py-10 text-stone-500">
                Hiç hili tagam tapylmady
            </div>

        @endforelse

    </div>

</div>

<div class="mt-6 mx-6" id="pagination-container">
    {{ $dishes->links() }}
</div>