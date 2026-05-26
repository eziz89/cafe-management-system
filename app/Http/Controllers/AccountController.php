<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\Comment;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $orders = $user->orders()->latest()->take(5)->get();

        $reservations = $user->reservations()->latest()->take(5)->get();

        $comments = $user->comments()->latest()->take(5)->get();

        return view('account.index', compact('user', 'orders', 'reservations', 'comments'));
    }
}
