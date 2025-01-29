<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
    ];

    // public function blogs()
    // {
    //     return $this->belongsToMany(Blog::class, 'tag_blog');
    // }
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'tag_blog', 'tag_id', 'blog_id');
    }
}
