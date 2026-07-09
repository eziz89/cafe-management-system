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

            <tr onclick="window.location='{{ route('admin.categories.show', $category) }}'" class="cursor-pointer border-b border-stone-200 hover:bg-orange-50 hover:shadow-sm transition">
                <td class="px-6 py-5">
                    <span class="font-semibold text-lg text-orange-600">
                        
                        {{ $category->name }}
                        
                    </span>
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
                    <div>
                        {{ $category->created_at->format('M d, Y') }}
                    </div>
                </td>

                <td onclick="event.stopPropagation()" class="px-6 py-5">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="px-4 py-2 rounded-xl bg-yellow-100 text-yellow-700 hover:bg-yellow-200 transition">
                            ✏️ Edit
                        </a>

                        <form
                            action="{{ route('admin.categories.destroy', $category) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')

                            <button class="px-4 py-2 rounded-xl bg-red-100 text-red-600 hover:bg-red-200 transition">
                                🗑️ Delete
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
