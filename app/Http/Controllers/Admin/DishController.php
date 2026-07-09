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

        if ($request->filled('status')) {
            $query->where('status', $request->status);
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
        
        $dishes = $query->latest()->paginate(5)->withQueryString();

        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.dishes.partials.table', compact('dishes'));
        }

        return view('admin.dishes.index', [
            'dishes' => $dishes,
            'stats' => [
                'totalDishes' => Dish::count(),
                'totalCategories' => Category::count(),
                'averagePrice' => $dishes->avg('price'),
                'highestPrice' => $dishes->max('price'),
            ],
        ], compact('dishes', 'categories'));
    }

    public function create(Request $request)
    {
        $categories = Category::all();

        return view('admin.dishes.create', [
            'categories' => $categories,
            'selectedCategory' => $request->category,
        ]);
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
            'category_id' => 'required|exists:categories,id',
            'status' => 'required', 'in:available,coming_soon,out_of_stock',
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'status' => 'required', 'in:available,coming_soon,out_of_stock',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('dishes', 'public');
            $validated['image'] = $path;
        }

        Dish::create($validated);

        if ($dish->category) {
            return redirect()->route('admin.categories.show', $dish->category)->with('success', 'Dish created successfully.');
        }

        return redirect()->route('admin.dishes.index')->with('success', 'Dish created successfully!');
    }

    public function destroy($id)
    {
        $dish = Dish::findOrFail($id);
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('success', 'Dish deleted successfully!');
    }

    public function updateStatus(Request $request, Dish $dish)
    {
        $request->validate([
            'status' => 'required|in:available,coming_soon,out_of_stock'
        ]);
    
        $dish->update([
            'status' => $request->status
        ]);
    
        return response()->json([
            'success' => true,
            'status' => $dish->status,
        ]);
    }
}
