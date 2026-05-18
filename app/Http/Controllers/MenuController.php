<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;

class MenuController extends Controller
{
    public function index()
    {
        $dishes = Dish::orderBy('created_at', 'desc')->get();
        return view('menu', compact('dishes'));
    }

    public function show($id)
    {
        $dish = Dish::findOrFail($id);
        return view('dish', compact('dish'));
    }
}