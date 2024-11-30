<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'type',
        'state',
        'brand',
        'material',
        'size',
        'image_path',
        'status'
    ];

    public function productPrices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id');
    }

    public function batchProducts()
    {
        return $this->hasMany(BatchProduct::class, 'product_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }
}
