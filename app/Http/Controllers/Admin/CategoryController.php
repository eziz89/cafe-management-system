<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('dishes')->latest()->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {

            $validated['image'] = $request->file('image')->store('categories', 'public');

        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {

            if ($category->image && Storage::disk('public')->exists($category->image)) {

                Storage::disk('public')->delete($category->image);

            }

            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }

    public function show(Request $request, Category $category)
    {
        $query = $category->dishes();

        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        switch ($request->get('sort', 'newest')) {
    
            case 'oldest':
                $query->oldest();
                break;
            
            case 'price_asc':
                $query->orderBy('price');
                break;
            
            case 'price_desc':
                $query->orderByDesc('price');
                break;
            
            case 'name_asc':
                $query->orderBy('name');
                break;
            
            case 'name_desc':
                $query->orderByDesc('name');
                break;
            
            default:
                $query->latest();
        }

        $dishes = $query->paginate(10)->withQueryString();

        if ($request->ajax()) {

            return view('admin.dishes.partials.table', compact('dishes'));

        }

        return view('admin.categories.show', compact('category', 'dishes'));
    }
}