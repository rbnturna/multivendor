<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image',
    ];

    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    // public function blogs()
    // {
    //     return $this->belongsToMany(Blog::class, 'category_blog');
    // }

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'category_blog', 'category_id', 'blog_id');
    }
}
