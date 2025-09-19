<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{ use HasCustomMedia;
    protected $fillable = [
        'title',
        'content',
        'author',
        'published_at'
    ];

     public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['author'])) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }

        return $query;
    }

}
