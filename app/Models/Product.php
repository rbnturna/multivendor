<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'image',
        'gallery_images',
        'price',
        'selling_price',
        'description',
        'short_description',
        'stock',
        'is_active',
        'is_featured',
        'brand',
        'category_id',
        'vendor_id',
        'tax',
        'weight',
        'length',
        'width',
        'height',
        'views',
        'rating',
        'total_reviews',
        'sold',
        'available_from',
        'available_until',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'gallery_images' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'available_from' => 'datetime',
        'available_until' => 'datetime',
    ];

    public function variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }
}
