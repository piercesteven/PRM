<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchProduct extends Model
{
    protected $fillable = [
        'product_id',
        'batch_id',
        'state',
        'dot',
        'original_quantity',
        'quantity_left',
        'price',
        'sub_total',
        'sell_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
