<div class="bg-white rounded-3xl shadow-lg overflow-hidden">

    <table class="w-full">

        <thead class="bg-stone-50">
            <tr>
                <th class="px-6 py-4 text-left">Category</th>
                <th class="px-6 py-4 text-left">Dishes</th>
                <th class="px-6 py-4 text-left">Created</th>
                <th class="px-6 py-4 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($categories as $category)

            <tr class="border-b border-gray-400 hover:bg-orange-50 hover:shadow-sm transition">
                <td class="px-6 py-5">
                    <div class="font-semibold text-stone-800 text-lg">
                        {{ $category->name }}
                    </div>
                </td>

                <td class="px-6 py-5">
                    <span class="inline-flex items-center
                                 bg-orange-100 text-orange-700
                                 px-3 py-1 rounded-full
                                 text-sm font-semibold">
                        🍽 {{ $category->dishes_count }}
                    </span>
                </td>
                
                <td class="px-6 py-5 text-stone-500">
                </td>

                <td class="px-6 py-5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="w-10 h-10 rounded-xl
                                  bg-yellow-100 hover:bg-yellow-200
                                  flex items-center justify-center
                                  transition">
                            ✏️
                        </a>

                        <form
                            action="{{ route('admin.categories.destroy', $category) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')

                            <button
                                class="w-10 h-10 rounded-xl
                                       bg-red-100 hover:bg-red-200
                                       flex items-center justify-center
                                       transition">
                                🗑️
                            </button>
                        </form>

                    </div>
                </td>
            </tr>

            @empty

            <tr>
                <td colspan="4" class="py-20 text-center">
                    <div class="text-6xl mb-5">
                        📂
                    </div>
                    <h2 class="text-2xl font-bold mb-2">
                        No categories yet
                    </h2>
                    <p class="text-stone-500 mb-8">
                        Create your first category to organize the menu.
                    </p>
                    <a
                        href="{{ route('admin.categories.create') }}"
                        class="inline-block
                               bg-orange-500 hover:bg-orange-600
                               text-white font-semibold
                               px-6 py-3 rounded-2xl">
                        + Add Category
                    </a>
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>
    
</div>
