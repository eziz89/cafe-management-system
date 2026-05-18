@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto">
        <a href="/admin/dishes/create" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">
            + Add Dish
        </a>

        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr class="border-b">
                    <th class="py-2">Name</th>
                    <th class="py-2">Category</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($dishes as $dish)
                    <tr class="border-b text-center">
                        <td class="py-2">{{ $dish->name }}</td>
                        <td class="py-2">{{ $dish->category->name ?? 'No Category' }}</td>
                        <td class="py-2">{{ $dish->price }}</td>
                        <td class="py-2">
                            <a href="/admin/dishes/{{ $dish->id }}/edit" class="text-yellow-500 mr-2">
                                Edit
                            </a>

                            <form action="/admin/dishes/{{ $dish->id }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this dish?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection