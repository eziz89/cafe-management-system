<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Comment;

class DishController extends Controller
{
    public function rate(Request $request, $dishId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'dish_id' => $dishId,
            ],
            [
                'rating' => $request->rating
            ]
        );

        return redirect()->back()->with('success', 'Rating submitted');
    }

    public function comment(Request $request, $dishId)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:1000'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'dish_id' => $dishId,
            'comment' => $request->comment
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
