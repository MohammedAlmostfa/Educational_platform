<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasCustomMedia;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'author',
        'published_at'
    ];

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
     * Scope to search articles by title or author.
     *
     * Usage: Article::search('term')->get();
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->orWhere('title', 'like', '%' . $term . '%')
                  ->orWhere('author', 'like', '%' . $term . '%');
            });
        }

        return $query;
    }

}
