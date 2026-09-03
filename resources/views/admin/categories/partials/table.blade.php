{{-- Desktop --}}
<div class="hidden md:block bg-white rounded-3xl shadow-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-stone-50">

            <tr>
                <th class="px-6 py-4 text-left">Kategoriýa</th>
                <th class="px-6 py-4 text-left">Tagamlar</th>
                <th class="px-6 py-4 text-left">Döredildi</th>
                <th class="px-6 py-4 text-left">Hereketler</th>
            </tr>

        </thead>

        <tbody>

            @forelse($categories as $category)

                <tr
                    onclick="window.location='{{ route('admin.categories.show', $category) }}'"
                    class="cursor-pointer border-b border-stone-200 hover:bg-orange-50 transition">

                    <td class="px-6 py-5">

                        <span class="font-semibold text-lg text-orange-600">
                            {{ $category->name }}
                        </span>

                    </td>

                    <td class="px-6 py-5">

                        <span class="inline-flex items-center gap-1
                                bg-orange-100 text-orange-700
                                px-3 py-1 rounded-full
                                text-sm font-semibold">

                            <i data-lucide="utensils" class="w-4 h-4"></i>

                            {{ $category->dishes_count }}

                        </span>

                    </td>

                    <td class="px-6 py-5 text-stone-500">

                        {{ $category->created_at->format('M d, Y') }}

                    </td>

                    <td
                        onclick="event.stopPropagation()"
                        class="px-6 py-5">

                        <div class="flex items-center gap-3">

                            <a
                                href="{{ route('admin.categories.edit', $category) }}"
                                class="inline-flex items-center gap-2 px-4 py-2
                                    rounded-xl bg-yellow-100 text-yellow-700
                                    hover:bg-yellow-200 transition">

                                <i data-lucide="pencil" class="w-4 h-4"></i>

                                Üýtgetmek

                            </a>

                            <form
                                action="{{ route('admin.categories.destroy', $category) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this category?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="inline-flex items-center gap-2 px-4 py-2
                                           rounded-xl bg-red-100 text-red-600
                                           hover:bg-red-200 transition">

                                    <i data-lucide="trash-2" class="w-4 h-4"></i>

                                    Pozmak

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4" class="py-20 text-center">

                        <i
                            data-lucide="folder-x"
                            class="w-16 h-16 mx-auto text-stone-400 mb-5">
                        </i>

                        <h2 class="text-2xl font-bold mb-2">
                            Entek kategoriýalar ýok
                        </h2>

                        <p class="text-stone-500 mb-8">
                            Menýuny tertipleşdirmek üçin ilkinji kategoriýaňyzy dörediň.
                        </p>

                        <a
                            href="{{ route('admin.categories.create') }}"
                            class="inline-flex items-center gap-2
                                   bg-orange-500 hover:bg-orange-600
                                   text-white font-semibold
                                   px-6 py-3 rounded-2xl">

                            <i data-lucide="plus" class="w-5 h-5"></i>

                            Kategoriýa goş

                        </a>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

{{-- Mobile --}}
<div class="md:hidden space-y-4">

    @forelse($categories as $category)

        <div
            onclick="window.location='{{ route('admin.categories.show', $category) }}'"
            class="bg-white rounded-3xl shadow-md p-5
                border border-stone-100
                hover:shadow-lg transition cursor-pointer">

            <div class="flex items-start justify-between gap-4">

                <div class="min-w-0">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-2xl
                                   bg-orange-50
                                   flex items-center justify-center
                                   shrink-0">

                            <i
                                data-lucide="folder"
                                class="w-5 h-5 text-orange-500">
                            </i>

                        </div>

                        <div class="min-w-0">

                            <h2 class="font-bold text-lg text-stone-800 truncate">
                                {{ $category->name }}
                            </h2>

                            <p class="text-sm text-stone-500">
                                {{ $category->created_at->format('M d, Y') }}
                            </p>

                        </div>

                    </div>

                </div>

                <span
                    class="inline-flex items-center gap-1
                           bg-orange-100 text-orange-700
                           px-3 py-1 rounded-full
                           text-xs font-semibold
                           shrink-0">

                    <i data-lucide="utensils" class="w-3.5 h-3.5"></i>

                    {{ $category->dishes_count }}

                </span>

            </div>

            <div
                onclick="event.stopPropagation()"
                class="flex gap-3 mt-5">

                <a
                    href="{{ route('admin.categories.edit', $category) }}"
                    class="w-1/2 inline-flex items-center justify-center gap-2
                           bg-yellow-100 text-yellow-700
                           py-2.5 rounded-xl font-semibold">

                    <i data-lucide="pencil" class="w-4 h-4"></i>

                    Üýtgetmek

                </a>

                <form
                    action="{{ route('admin.categories.destroy', $category) }}"
                    method="POST"
                    class="w-1/2"
                    onsubmit="return confirm('Delete this category?')">

                    @csrf
                    @method('DELETE')

                    <button
                        class="w-full inline-flex items-center justify-center gap-2
                               bg-red-100 text-red-600
                               py-2.5 rounded-xl font-semibold">

                        <i data-lucide="trash-2" class="w-4 h-4"></i>

                        Pozmak

                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="bg-white rounded-3xl shadow-md p-8 text-center">

            <i
                data-lucide="folder-x"
                class="w-16 h-16 mx-auto text-stone-400 mb-5">
            </i>

            <h2 class="text-2xl font-bold mb-2">
                Entek kategoriýalar ýok
            </h2>

            <p class="text-stone-500 mb-8">
                Menýuny tertipleşdirmek üçin ilkinji kategoriýaňyzy dörediň.
            </p>

            <a
                href="{{ route('admin.categories.create') }}"
                class="inline-flex items-center gap-2
                       bg-orange-500 hover:bg-orange-600
                       text-white font-semibold
                       px-6 py-3 rounded-2xl">

                <i data-lucide="plus" class="w-5 h-5"></i>

                Kategoriýa goş

            </a>

        </div>

    @endforelse

</div>