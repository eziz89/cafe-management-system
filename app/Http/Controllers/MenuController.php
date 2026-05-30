<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        $dishes = Dish::orderBy('created_at', 'desc')->get();

        $categories = Category::withCount('dishes')->get();
        
        return view('menu', compact('dishes', 'categories'));
    }

    public function show($id)
    {
        $dish = Dish::findOrFail($id);

        return view('dish', compact('dish'));
    }
}