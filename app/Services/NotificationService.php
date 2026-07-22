<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\Order;

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
}