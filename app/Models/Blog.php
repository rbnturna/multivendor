<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'short_description',
        'is_active',
        'vendor_id',
        'views',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

   

    // public function categories()
    // {
    //     return $this->belongsToMany(BlogCategory::class, 'category_blog');
    // }

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'category_blog', 'blog_id', 'category_id');
    }

    // public function tags()
    // {
    //     return $this->belongsToMany(BlogTag::class, 'tag_blog');
    // }
    
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'tag_blog', 'blog_id', 'tag_id');
    }
}
