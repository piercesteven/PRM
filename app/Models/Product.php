<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'type',
        'brand',
        'material',
        'size',
        'image_path',
        'status',
        'stocks',
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

    public function brandnewStocks()
    {
        return $this->batchProducts()
            ->where('state', 'Brand New')
            ->sum('quantity_left');
    }

    public function secondhandStocks()
    {
        return $this->batchProducts()
            ->where('state', 'Secondhand')
            ->sum('quantity_left');
    }

    public function currentPrice()
    {
        $current_price =  $this->productPrices()
            ->whereNull('effective_date')
            ->first();

        return $current_price->price ?? null;
    }
}
