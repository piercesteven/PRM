<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = [
        'batch_number',
        'is_closed',
    ];

    public function batchProducts()
    {
        return $this->hasMany(BatchProduct::class, 'batch_id');
    }
}
