<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Services\NotificationService;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->getReservations($request);

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
                break;
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

    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'status' => $request->status,
        ]);

        $reservation->refresh();

        $this->notificationService->reservationStatusChanged($reservation);

        return response()->json([
            'success' => true,
            'status' => $reservation->status,
        ]);
    }

    private function getReservations(Request $request)
    {
        $query = Reservation::query();
    
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
    
        if ($request->filled('search')) {
        
            $search = $request->search;
        
            $query->where(function ($q) use ($search) {
            
                $q->where('id', 'like', "%{$search}%")->orWhere('customer_name', 'like', "%{$search}%")->orWhere('customer_phone', 'like', "%{$search}%");
            
            });
        }
    
        return $query;
    }

    public function live(Request $request)
    {
        $query = $this->getReservations($request);

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
                break;
        }

        $reservations = $query->paginate(10)->withQueryString()->withPath(route('admin.reservations.index'));

        return view(
            'admin.reservations.partials.table',
            compact('reservations')
        );
    }
}