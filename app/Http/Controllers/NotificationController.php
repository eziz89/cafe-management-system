<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        $user->notifications()->where('is_read', false)->update([
                'is_read' => true,
            ]);

        $notifications = $user->notifications()->paginate(10);

        return view('notifications.index', compact('notifications'));
    }

    public function unread()
    {
        $notifications = Auth::user()->notifications()->where('is_read', false)->get();

        return response()->json([
            'count' => $notifications->count(),
        ]);
    }

    public function markAsRead(Notification $notification)
    {
        dd('markAsRead called');
        
        abort_if(
            $notification->user_id !== Auth::id(),
            403
        );

        $notification->update([
            'is_read' => true,
        ]);

        return response()->json([
            'success' => true,
            'unread' => Auth::user()->notifications()->where('is_read', false)->count(),
        ]);
    }

    public function poll()
    {
        $notifications = Auth::user()->notifications()->where('is_read', false)->latest()->take(5)->get();

        return response()->json([
            'count' => $notifications->count(),

            'notifications' => $notifications->map(function ($notification) {

                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                ];

            }),
        ]);
    }
}
