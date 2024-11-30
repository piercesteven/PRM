<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'grand_total',
        'order_status',
        'transact_by',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'transact_by');
    }
}
