@extends('layouts.admin')

@section('content')

<div class="max-w-5xl mx-auto py-8">

    <div class="mb-10">

        <p class="text-orange-500 uppercase tracking-[0.3em] font-semibold mb-2">
            Admin Panel
        </p>

        <h1 class="text-4xl font-bold text-stone-900">
            ➕ Create Category
        </h1>

        <p class="text-stone-500 mt-2">
            Add a new category to organize your menu.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('admin.categories.store') }}" method="POST">

            @csrf
        
            <div class="mb-6">
        
                <label class="block font-semibold mb-2">
                    Category Name
                </label>
        
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
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
        
            <div class="flex gap-4">
        
                <button
                    class="bg-orange-500 hover:bg-orange-600
                        text-white font-semibold
                        px-6 py-3 rounded-2xl transition">
        
                    Create Category
        
                </button>
        
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="bg-stone-200 hover:bg-stone-300
                        px-6 py-3 rounded-2xl
                        font-semibold transition">
        
                    Cancel
        
                </a>
        
            </div>
        
        </form>

    </div>

</div>

@endsection