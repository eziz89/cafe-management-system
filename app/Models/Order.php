<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function printJobs()
    {
        return $this->hasMany(PrintJob::class);
    }

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'customer_name',
        'customer_phone',
        'customer_address',
        'order_type',
        'payment_method',
        'notes',
        'status',
    ];
}