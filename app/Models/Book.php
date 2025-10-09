<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasCustomMedia;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'author'];

    /**
     * Polymorphic relationship for associated media files.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
    /**
     * Scope to search books by a search term.
     * Searches only in 'name' and 'author' columns.
     *
     * Example usage:
     * Book::search('Laravel')->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->orWhere('name', 'like', '%' . $term . '%')
                  ->orWhere('author', 'like', '%' . $term . '%');
            });
        }

        return $query;
    }
}
