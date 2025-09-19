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

    /**
     * Scope to filter books based on given filters.
     *
     * Usage: Book::filter($filters)->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['author'])) {
            $query->where('author', 'like', '%' . $filters['author'] . '%');
        }

        return $query;
    }
}
