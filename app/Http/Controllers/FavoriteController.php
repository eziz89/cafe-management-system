<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class FavoriteController extends Controller
{
    public function toggle(Request $request, Dish $dish)
    {
        $user = auth()->user();

        $result = $user->favorites()->toggle($dish->id);

        $favorited = count($result['attached']) > 0;
        
        if ($request->ajax()) {

            return response()->json([
                'status' => 'success',
                'favorited' => $favorited,
            ]);
        
        }

        return redirect()->back()->with('success', 'Favorites updated successfully.');
    }
 
    public function index()
    {
        $dishes = auth()->user()->favorites()->latest()->get();

        return view('favorites.index', compact('dishes'));
    }
}
