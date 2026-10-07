<?php

namespace App\Services;

use App\Models\Order;

class ReceiptFormatter
{
    public function format(Order $order): string
    {
        $order->loadMissing('orderItems.dish');

        $lines = [];

        $lines[] = '================================';
        $lines[] = '         GUBADAG FITÇI';
        $lines[] = '================================';
        $lines[] = 'Order #' . $order->id;
        $lines[] = $order->created_at->format('d.m.Y H:i');
        $lines[] = '';

        $lines[] = 'Customer: ' . $order->customer_name;
        $lines[] = 'Phone: ' . $order->customer_phone;
        $lines[] = 'Type: ' . strtoupper(str_replace('_', ' ', $order->order_type));
        $lines[] = 'Payment: ' . strtoupper($order->payment_method);

        if ($order->customer_address) {
            $lines[] = 'Address: ' . $order->customer_address;
        }

        $lines[] = '';
        $lines[] = '--------------------------------';
        $lines[] = 'ITEMS';
        $lines[] = '--------------------------------';

        foreach ($order->orderItems as $item) {
            $name = $item->dish?->name ?? 'Unknown item';
            $quantity = $item->quantity;
            $price = number_format($item->price, 2);
            $subtotal = number_format($item->price * $item->quantity, 2);

            $lines[] = $name;
            $lines[] = '  ' . $quantity . ' x ' . $price . ' = ' . $subtotal;
        }

        $lines[] = '--------------------------------';
        $lines[] = 'TOTAL: ' . number_format($order->total_price, 2);
        $lines[] = '--------------------------------';

        if ($order->notes) {
            $lines[] = 'Notes:';
            $lines[] = $order->notes;
            $lines[] = '--------------------------------';
        }

        $lines[] = '';
        $lines[] = '          THANK YOU!';
        $lines[] = '================================';

        return implode(PHP_EOL, $lines);
    }
}