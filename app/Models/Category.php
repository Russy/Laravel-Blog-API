<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'posts_categories');
    }
}
