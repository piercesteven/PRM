<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'change',
        'payment_method',
        'reference_number',
        'status',
    ];
}
