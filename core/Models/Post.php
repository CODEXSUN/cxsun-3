<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'status'];
    protected $table = 'posts';

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}