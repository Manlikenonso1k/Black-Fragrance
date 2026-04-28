<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'sku',
        'volume',
        'price',
        'stock',
        'image',
        'attributes',
        'is_default',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_default' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
