<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class StockTransaction extends Model
{
    protected $fillable = [
        'product_id',
        'type',
        'qty',
        'notes',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}