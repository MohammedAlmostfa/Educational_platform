<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'published_at'
    ];

     public function photo()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

}
