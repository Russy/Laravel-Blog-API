<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'slug', 'is_published'
    ];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'posts_tags');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'posts_categories');
    }
}
