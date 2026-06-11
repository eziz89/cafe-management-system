<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class FavoriteController extends Controller
{
    public function toggle(Dish $dish)
    {
        $user = auth()->user();

        $favorited = $user->favorites()->toggle($dish->id);
        
        return response()->json([
            'status' => 'success',
            'favorited' => count($favorited['attached']) > 0
        ]);  
    }

    public function index()
    {
        $dishes = auth()->user()
        ->favorites()
        ->latest()
        ->get();

        return view('favorites.index', compact('dishes'));
    }
}
