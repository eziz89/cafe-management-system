@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-2xl font-bold mb-4">Edit Dish</h1>

        <form method="POST" action="/admin/dishes/{{ $dish->id }}">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $dish->name }}" class="block mb-2 p-2 border w-full">
            <textarea name="description" class="block mb-2 p-2 border w-full">{{ $dish->description }}</textarea>
            <input type="number" step="0.01" name="price" value="{{ $dish->price }}" class="block mb-2 p-2 border w-full">
            <select name="category_id" class="block mb-2 p-2 border w-full">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $dish->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button class="bg-blue-500 text-white px-4 py-2 rounded">Update Dish</button>
        </form>
    </div>
@endsection