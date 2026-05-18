<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->get();

        return view('admin.reservations.index', compact('reservations'));
    }
    public function create()
    {
        return view('reservations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'guests' => 'required|integer|min:1',
            'reservation_time' => 'required|date',
            'message' => 'nullable',
        ]);

        Reservation::create($validated);

        return redirect('/')->with('success', "Reservation submitted successfully.");
    }
}
