@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-2xl font-bold mb-4">Add New Dish</h1>

        @if($errors->any())
            <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/admin/dishes" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Dish Image
                </label>
                <input type="file" name="image" class="w-full border p-3">
            </div>
            <input type="text" name="name" placeholder="Name" class="block mb-2 p-2 border w-full">
            <input type="text" name="name_en" placeholder="Name in English" class="block mb-2 p-2 border w-full">
            <input type="text" name="name_ru" placeholder="Name in Russian" class="block mb-2 p-2 border w-full">
            <textarea name="description" placeholder="Description" class="block mb-2 p-2 border w-full"></textarea>
            <textarea name="description_en" placeholder="Description in English" class="block mb-2 p-2 border w-full"></textarea>
            <textarea name="description_ru" placeholder="Description in Russian" class="block mb-2 p-2 border w-full"></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" class="block mb-2 p-2 border w-full">
            <select name="category_id" class="block mb-2 p-2 border w-full">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Add Dish</button>
        </form>
    </div>
@endsection