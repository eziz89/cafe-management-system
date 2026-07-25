<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Dish::query();

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('name_en', 'like', "%{$search}%")
                ->orWhere('name_ru', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('description_en', 'like', "%{$search}%")
                ->orWhere('description_ru', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $sort = $request->get('sort', 'newest');

        switch ($sort) {
            case 'price_low':
                $query->orderBy('price');
                break;
            
            case 'price_high':
                $query->orderByDesc('price');
                break;

            case 'top_rated':
                $query->withAvg('ratings', 'rating')
                ->orderByDesc('ratings_avg_rating');
                break;

            default:
                $query->orderByDesc('created_at');
        }

        $dishes = $query->paginate(9)->withQueryString();
 
        $totalDishes = Dish::count();

        $categories = Category::withCount('dishes')->get();

        if ($request->ajax()) {

            return response()->json([

                'grid' => view(
                    'dishes.grid',
                    compact('dishes')
                )->render(),
                
                'info' => view(
                    'dishes.info',
                    compact(
                        'dishes',
                        'categories'
                    )
                )->render(),
                    
                'filters' => view(
                    'dishes.filters',
                    compact(
                        'categories'
                    )
                )->render(),
                    
            ]);
        
        }
        
        return view('menu', compact('dishes', 'categories', 'totalDishes'));
    }

    public function show($id)
    {
        $dish = Dish::findOrFail($id);

        return view('dish', compact('dish'));
    }
}