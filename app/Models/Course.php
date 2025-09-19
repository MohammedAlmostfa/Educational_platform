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
}
