@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto sm:pt-4 pb-8 sm:px-0 px-4">

    <div class="sm:mb-6 mb-4">

        <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
            Dolandyryş paneli
        </p>

        <h1 class="flex items-center sm:text-4xl text-3xl font-bold text-stone-900 gap-2">
            <i data-lucide="pencil" class="w-8 h-8 text-orange-500"></i>
            Kategoriýany üýtget
        </h1>

        <p class="text-stone-500 mt-2">
            Kategoriýa maglumatlaryny täzeläň.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg sm:p-8 p-6">

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
        
            <div class="mb-5">
        
                <label class="flex items-center block text-lg font-semibold mb-2 gap-2">
                    <i data-lucide="image" class="w-5 h-5 text-orange-500"></i>
                    Kategoriýa suraty
                </label>
        
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
        
                    <p class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </p>
        
                @enderror
        
            </div>

            @if($category->image)

                <div class="mt-2 mb-5">

                    <p class="text-sm font-medium text-stone-700 mb-1">
                        Häzirki surat
                    </p>

                    <p class="text-sm text-stone-500 mb-3">
                        Diňe ony çalşyrmak isleýän bolsaňyz, ýokarda täze surat ýükläň.
                    </p>

                    <img
                        src="{{ asset('storage/' . $category->image) }}"
                        class="w-48 h-32 object-cover rounded-2xl border">

                </div>

            @endif

            <div class="mb-5">
        
                <label class="flex items-center block text-lg font-semibold mb-2 gap-2">
                    <i data-lucide="info" class="w-5 h-5 text-orange-500"></i>
                    Kategoriýa ady
                </label>
        
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="w-full rounded-2xl border border-stone-300
                           px-5 py-3
                           focus:outline-none
                           focus:ring-2
                           focus:ring-orange-300">
        
                @error('name')
        
                    <p class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </p>
        
                @enderror
        
            </div>

            <div class="mb-6">

                <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">
                    <i data-lucide="languages" class="w-5 h-5 text-orange-500"></i>
                    Köpdilli atlar
                </h2>

                <input
                    type="text"
                    name="name_en"
                    value="{{ old('name_en', $category->name_en) }}"
                    placeholder="Iňlisçe ady"
                    class="w-full rounded-2xl border border-stone-300
                           px-5 py-3 mb-3
                           focus:outline-none focus:ring-2 focus:ring-orange-300">

                @error('name_en')
                    <p class="text-red-500 text-sm mb-3">
                        {{ $message }}
                    </p>
                @enderror

                <input
                    type="text"
                    name="name_ru"
                    value="{{ old('name_ru', $category->name_ru) }}"
                    placeholder="Rus ady"
                    class="w-full rounded-2xl border border-stone-300
                        px-5 py-3
                        focus:outline-none focus:ring-2 focus:ring-orange-300">

                @error('name_ru')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-5">
        
                <label class="flex items-center block text-lg font-semibold mb-2 gap-2">
                    <i data-lucide="file-text" class="w-5 h-5 text-orange-500"></i>
                    Düşündiriş
                </label>
        
                <textarea
                    name="description"
                    rows="4"
                    class="w-full rounded-2xl border border-gray-300 px-5 py-4">{{ old('description', $category->description) }}</textarea>
        
                @error('description')
        
                    <p class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </p>
        
                @enderror
        
            </div>
        
            <div class="sm:mb-8 mb-4">

                <h2 class="text-lg font-semibold mb-4 text-stone-800 flex items-center gap-2">
                    <i data-lucide="languages" class="w-5 h-5 text-orange-500"></i>
                    Köpdilli Düşündirişler
                </h2>
            
                <textarea
                    name="description_en"
                    rows="4"
                    placeholder="Iňlisçe düşündiriş"
                    class="w-full rounded-2xl border border-stone-300
                        px-5 py-4 mb-3
                        focus:outline-none focus:ring-2 focus:ring-orange-300">{{ old('description_en', $category->description_en) }}</textarea>
            
                @error('description_en')
                    <p class="text-red-500 text-sm mb-3">
                        {{ $message }}
                    </p>
                @enderror
            
                <textarea
                    name="description_ru"
                    rows="4"
                    placeholder="Rusça düşündiriş"
                    class="w-full rounded-2xl border border-stone-300
                        px-5 py-4
                        focus:outline-none focus:ring-2 focus:ring-orange-300">{{ old('description_ru', $category->description_ru) }}</textarea>
            
                @error('description_ru')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            
            </div>

            <div class="flex justify-between gap-3 sm:gap-4">
        
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="sm:w-auto text-center bg-stone-200 hover:bg-stone-300
                        px-6 py-3 rounded-2xl font-semibold transition">
                    Ýatyr
                </a>
        
                <button
                    class="sm:w-auto bg-orange-500 hover:bg-orange-600
                        text-white font-semibold
                        px-6 py-3 rounded-2xl transition">
                    Kategoriýany täzele 
                </button>

            </div>
        
        </form>

    </div>

</div>

@endsection