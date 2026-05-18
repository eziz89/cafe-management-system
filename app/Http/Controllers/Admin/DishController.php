<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Http\Request;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::with('category')->latest()->get();
        return view('admin.dishes.index', compact('dishes'));
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
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $dish->update($validated);

        return redirect('/admin/dishes')->with('success', 'Dish updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dishes', 'public');
            $validated['image'] = $path;
        }

        Dish::create($validated);

        return redirect('/admin/dishes')->with('success', 'Dish created successfully!');
    }

    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect('/admin/dishes')->with('success', 'Dish deleted successfully!');
    }
}
