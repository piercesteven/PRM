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
    ];
}
