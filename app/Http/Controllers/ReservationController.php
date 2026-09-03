<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
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
        
        $validated['user_id'] = auth()->check() ? auth()->id() : null;
        
        $reservation = Reservation::create($validated);

        return redirect()->route('reservations.success', $reservation);
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

    public function status(Reservation $reservation)
    {
        return response()->json([
        
            'badge' => view(
                'reservations.partials.badge',
                [
                    'reservation' => $reservation
                ]
            )->render(),
                
        ]);
    }

    public function success(Reservation $reservation)
    {
        return view('reservations.success', compact('reservation'));
    }
}
