<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{ use HasCustomMedia;
protected $fillable = [
        'title',
        'description',
        'instructor',
        'duration',
        'price'
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

        if (isset($filters['instructor'])) {
            $query->where('instructor', 'like', '%' . $filters['instructor'] . '%');
        }

        return $query;
    }
}
