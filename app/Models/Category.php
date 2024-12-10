<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
    ];

    // Define relationship for parent category
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    // Define relationship for subcategories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
