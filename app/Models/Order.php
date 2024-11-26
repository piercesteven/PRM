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
}
