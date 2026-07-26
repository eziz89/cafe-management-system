<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with([
            'dishes' => function ($query) {
            
                $query->withAvg('ratings', 'rating')->orderByDesc('ratings_avg_rating')->take(3);
            
            }
        ])->withCount('dishes')->get();
        
        return view('categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::with('dishes')->findOrFail($id);

        return view('categories.show', compact('category'));
    }
}
