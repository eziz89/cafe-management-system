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
            'name' => 'required|min:2|max:255',
            'phone' => 'required|min:8|max:20',
            'guests' => 'required|integer|min:1|max:20',
            'reservation_time' => 'required|date|after:now',
            'message' => 'nullable',
        ]);
        
        $validated['user_id'] = auth()->id();
        
        Reservation::create($validated);

        return redirect()->route('reservations.my')->with('success', "Reservation submitted successfully.");
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => $request->status,
        ]);

        return back();
    }

    public function myReservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())->latest()->get();

        return view('reservations.my-reservations', compact('reservations'));
    }
}
