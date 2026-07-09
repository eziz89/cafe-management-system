<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::query();
    
        if ($request->filled('search')) {
        
            $search = $request->search;
        
            $query->where(function ($q) use ($search) {
            
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            
            });
        
        }
    
        if ($request->filled('status')) {
        
            $query->where(
                'status',
                $request->status
            );
        
        }
    
        switch ($request->get('sort', 'newest')) {
        
            case 'oldest':
                $query->oldest();
                break;
            
            case 'guests_desc':
                $query->orderByDesc('guests');
                break;
            
            case 'time':
                $query->orderBy('reservation_time');
                break;
            
            default:
                $query->latest();
        }
    
        $reservations = $query->paginate(10)->withQueryString();
    
        if ($request->ajax()) {
        
            return view(
                'admin.reservations.partials.table',
                compact('reservations')
            );
        
        }
    
        return view(
            'admin.reservations.index',
            compact('reservations')
        );
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => $request->status,
        ]);

        $reservation->refresh();

        return response()->json([
            'success' => true,
            'status' => $reservation->status,
        ]);
    }
}
