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

}
