<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Variation extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['product_id', 'price', 'sale_price', 'image', 'stock_quantity', 'attributes'];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
