@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto px-6 pb-10">

        {{-- Header --}}
        <div class="sm:mb-6 mb-4">

            <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
                Dolandyryş paneli
            </p>

            <h1 class="flex items-center sm:text-4xl text-3xl font-bold text-stone-900 gap-2">
                <i data-lucide="plus" class="w-8 h-8 text-orange-500"></i>
                Tagam dörediň
            </h1>

            <p class="text-stone-500 mt-2">
                Menýuňyza täze tagam goşuň.
            </p>

        </div>

        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <form method="POST" action="/admin/dishes" enctype="multipart/form-data">
                @csrf

                <div class="mb-6">

                    <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">
                        <i data-lucide="image" class="w-5 h-5 text-orange-500"></i>
                        Tagamyň suraty
                    </h2>

                    <label
                        class="flex flex-col items-center justify-center w-full h-48
                        border-2 border-dashed border-stone-300 rounded-3xl
                        cursor-pointer hover:border-orange-400
                        hover:bg-orange-50 transition">

                        <i data-lucide="upload"
                            class="w-10 h-10 text-stone-400 mb-3">
                        </i>

                        <p class="text-stone-500">
                            Surat ýüklemek üçin basyň
                        </p>

                        <p class="text-sm text-stone-400">
                            5 MB-a çenli PNG, JPG
                        </p>

                        <input 
                            type="file"
                            name="image"
                            class="hidden">

                    </label>

                    @error('image')
                    <p class="text-red-500 text-sm mt-1 mb-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- Basic Info --}}
                
                <div class="mb-6">

                    <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">

                        <i data-lucide="info" class="w-5 h-5 text-orange-500"></i>

                        Esasy Maglumatlar

                    </h2>

                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        placeholder="Tagamyň ady"
                        class="mb-3 p-3 rounded-2xl border w-full focus:ring-2 focus:ring-orange-300">

                    @error('name')
                    <p class="text-red-500 text-sm mt-1 mb-2">
                        {{ $message }}
                    </p>
                    @enderror

                    <select name="category_id" class="p-3 mb-3 rounded-2xl border w-full focus:ring-2 focus:ring-orange-300">

                        <option value="">Kategoriýany saýlaň</option>

                        @foreach($categories as $category)
                            
                            <option value="{{ $category->id }}"
                                @selected(old('category_id', $selectedCategory) == $category->id)>
                                {{ $category->translated_name }}
                            </option>
                            
                        @endforeach

                    </select>

                    <div>
                        <select
                            name="status"
                            class="w-full rounded-xl border px-4 py-3 focus:ring-2 focus:ring-orange-400 focus:outline-none"
                        >
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                                Elýeterli
                            </option>

                            <option value="coming_soon" {{ old('status') == 'coming_soon' ? 'selected' : '' }}>
                                Ýakynda
                            </option>

                            <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>
                                Ambarda ýok
                            </option>
                        </select>

                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Multilingual Names --}}
                <div class="mb-6">

                    <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">
                        <i data-lucide="languages"
                           class="w-5 h-5 text-orange-500">
                        </i>
                        Köpdilli Atlar
                    </h2>

                    <input type="text" name="name_en"
                        value="{{ old('name_en') }}"
                        placeholder="Iňlis ady"
                        class="mb-3 p-3 rounded-2xl border w-full">

                    <input type="text" name="name_ru"
                        value="{{ old('name_ru') }}"
                        placeholder="Rus ady"
                        class="p-3 rounded-2xl border w-full">

                </div>

                {{-- Description --}}
                <div class="mb-4">

                    <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">
                        <i data-lucide="file-text"
                           class="w-5 h-5 text-orange-500">
                        </i>
                        Düşündiriş
                    </h2>

                    <textarea name="description"
                        placeholder="Esasy düşündiriş"
                        class="mb-3 p-3 rounded-2xl border w-full">{{ old('description') }}</textarea>

                    @error('description')
                    <p class="text-red-500 text-sm mt-1 mb-2">
                        {{ $message }}
                    </p>
                    @enderror

                    <textarea name="description_en"
                        placeholder="Iňlisçe düşündiriş"
                        class="mb-3 p-3 rounded-2xl border w-full">{{ old('description_en') }}</textarea>

                    <textarea name="description_ru"
                        placeholder="Rusça düşündiriş"
                        class="p-3 rounded-2xl border w-full">{{ old('description_ru') }}</textarea>

                </div>

                {{-- Price --}}
                <div class="mb-8">

                    <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">
                        <i data-lucide="badge-dollar-sign"
                           class="w-5 h-5 text-orange-500">
                        </i>
                        Baha
                    </h2>

                    <div class="relative">

                        <span class="absolute left-5 top-3 text-stone-400">
                            TMT
                        </span>

                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price') }}"
                            placeholder="0.00"
                            class="pl-16 p-3 rounded-2xl border w-full focus:ring-2 focus:ring-orange-300">

                    </div>

                    @error('price')
                    <p class="text-red-500 text-sm mt-1 mb-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                {{-- Actions --}}
                <div class="flex justify-between gap-4">

                    <a href="/admin/dishes"
                        class="bg-stone-200 hover:bg-stone-300
                            px-6 py-3 rounded-2xl font-semibold transition">

                        Ýatyr

                    </a>

                    <button
                        class="bg-orange-500 hover:bg-orange-600
                            text-white font-semibold
                            px-6 py-3 rounded-2xl transition">

                        Tagamy döret

                    </button>

                </div>

            </form>

        </div>

    </div>
@endsection