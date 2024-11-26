<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchProduct extends Model
{
    protected $fillable = [
        'product_id',
        'batch_id',
        'dot',
        'original_quantity',
        'quantity_left',
    ];
}
