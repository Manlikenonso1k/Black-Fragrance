<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'subtitle',
        'price',
        'volume',
        'image',
        'images',
        'colors',
        'category',
        'top_notes',
        'heart_notes',
        'base_notes',
        'ingredients',
        'care_instructions',
        'stock',
        'in_stock',
        'is_variable',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'images' => 'array',
        'colors' => 'array',
        'is_variable' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Get the route key for implicit route binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
