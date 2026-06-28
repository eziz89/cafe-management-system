<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index(Request $request)
    {
        $query = Dish::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $dishes = $query->latest()->get();

        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.dishes.partials.table', compact('dishes'));
        }

        return view('admin.dishes.index', [
            'dishes' => $dishes,
            'stats' => [
                'totalDishes' => $dishes->count(),
                'totalCategories' => Category::count(),
                'averagePrice' => $dishes->avg('price'),
                'highestPrice' => $dishes->max('price'),
            ],
        ], compact('dishes', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.dishes.create', compact('categories'));
    }

    public function edit($id)
    {
        $dish = Dish::findOrFail($id);
        $categories = Category::all();

        return view('admin.dishes.edit', compact('dish', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $dish = Dish::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $dish->update($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'name_en' => 'required|string|max:255',
            'name_ru' => 'required|string|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dishes', 'public');
            $validated['image'] = $path;
        }

        Dish::create($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish created successfully!');
    }

    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish deleted successfully!');
    }
}
