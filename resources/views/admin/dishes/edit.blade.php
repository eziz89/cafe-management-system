@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-10">

        {{-- Header --}}
        <div class="mb-10">
            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Admin Panel
            </p>

            <h1 class="text-4xl font-bold text-stone-900">
                ✏️ Edit Dish
            </h1>

            <p class="text-stone-500 mt-2">
                Update dish information and pricing.
            </p>
        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <form method="POST" action="/admin/dishes/{{ $dish->id }}">
                @csrf
                @method('PUT')

                <div class="mb-6">

                    <h2 class="text-lg font-semibold mb-4 text-stone-800">
                        Dish Image
                    </h2>

                    @if($dish->image)
                        <img src="{{ asset('storage/' . $dish->image) }}"
                             class="w-32 h-32 object-cover rounded-2xl mb-3">
                    @endif

                    <input type="file"
                           name="image"
                           class="p-3 rounded-2xl border w-full">

                </div>
                
                {{-- Basic Info --}}
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4 text-stone-800">
                        Basic Information
                    </h2>

                    <input type="text" name="name"
                        value="{{ $dish->name }}"
                        placeholder="Dish name"
                        class="mb-3 p-3 rounded-2xl border w-full focus:ring-2 focus:ring-orange-300">

                    <select name="category_id"
                        class="p-3 mb-3 rounded-2xl border w-full focus:ring-2 focus:ring-orange-300">

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $dish->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    <div>
                        <select
                            name="status"
                            class="w-full rounded-xl border px-4 py-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                        >
                            <option value="available"
                                {{ old('status', $dish->status) == 'available' ? 'selected' : '' }}>
                                🟢 Available
                            </option>

                            <option value="coming_soon"
                                {{ old('status', $dish->status) == 'coming_soon' ? 'selected' : '' }}>
                                🟡 Coming Soon
                            </option>

                            <option value="out_of_stock"
                                {{ old('status', $dish->status) == 'out_of_stock' ? 'selected' : '' }}>
                                🔴 Out of Stock
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Multilingual Names --}}
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4 text-stone-800">
                        Multilingual Names
                    </h2>

                    <input type="text" name="name_en"
                        value="{{ $dish->name_en }}"
                        placeholder="English name"
                        class="mb-3 p-3 rounded-2xl border w-full">

                    <input type="text" name="name_ru"
                        value="{{ $dish->name_ru }}"
                        placeholder="Russian name"
                        class="p-3 rounded-2xl border w-full">
                </div>

                {{-- Description --}}
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4 text-stone-800">
                        Description
                    </h2>

                    <textarea name="description"
                        placeholder="Main description"
                        class="mb-3 p-3 rounded-2xl border w-full">{{ $dish->description }}</textarea>

                    <textarea name="description_en"
                        placeholder="English description"
                        class="mb-3 p-3 rounded-2xl border w-full">{{ $dish->description_en }}</textarea>

                    <textarea name="description_ru"
                        placeholder="Russian description"
                        class="p-3 rounded-2xl border w-full">{{ $dish->description_ru }}</textarea>
                </div>

                {{-- Price --}}
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4 text-stone-800">
                        Pricing
                    </h2>

                    <input type="number" step="0.01" name="price"
                        value="{{ $dish->price }}"
                        placeholder="Price"
                        class="p-3 rounded-2xl border w-full focus:ring-2 focus:ring-orange-300">
                </div>

                {{-- Actions --}}
                <div class="flex gap-4">

                    <button
                        class="bg-orange-500 hover:bg-orange-600
                               text-white font-semibold
                               px-6 py-3 rounded-2xl transition">

                        Update Dish

                    </button>

                    <a href="/admin/dishes"
                       class="bg-stone-200 hover:bg-stone-300
                              px-6 py-3 rounded-2xl font-semibold transition">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection