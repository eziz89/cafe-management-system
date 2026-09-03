<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Order;
use App\Models\Reservation;

class NotificationService
{
    public function orderStatusChanged(Order $order): void
    {
        Notification::create([
            'user_id' => $order->user_id,

            'type' => 'order_status',

            'title' => match ($order->status) {

                'pending' => 'Order Received',
                'preparing' => 'Order Preparing 🍳',
                'completed' => 'Order Completed ✅',
                'cancelled' => 'Order Cancelled ❌',

            },

            'message' => match ($order->status) {

                'pending' => "Your order #{$order->id} has been received.",
                'preparing' => "Your order #{$order->id} is now being prepared.",
                'completed' => "Your order #{$order->id} has been completed.",
                'cancelled' => "Your order #{$order->id} has been cancelled.",

            },
        ]);
    }


    public function reservationStatusChanged(Reservation $reservation): void
    {
        // Guests cannot receive notifications
        if (!$reservation->user_id) {
            return;
        }

        Notification::create([

            'user_id' => $reservation->user_id,

            'type' => 'reservation_status',

            'title' => match ($reservation->status) {

                'pending' => 'Reservation Received 🪑',
                'confirmed' => 'Reservation Confirmed ✅',
                'cancelled' => 'Reservation Cancelled ❌',
                'completed' => 'Reservation Completed',

            },

            'message' => match ($reservation->status) {

                'pending' =>
                    "Your reservation #{$reservation->id} has been received.",

                'confirmed' =>
                    "Your reservation #{$reservation->id} has been confirmed.",

                'cancelled' =>
                    "Your reservation #{$reservation->id} has been cancelled.",

                'completed' =>
                    "Your reservation #{$reservation->id} has been completed.",

            },

        ]);
    }
}