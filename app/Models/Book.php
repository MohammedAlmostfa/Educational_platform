<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasCustomMedia;

    /**
     * Attributes that are mass assignable.
     */
    protected $fillable = ['name', 'description', 'author'];

    /**
     * Polymorphic relationship for associated media files.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
