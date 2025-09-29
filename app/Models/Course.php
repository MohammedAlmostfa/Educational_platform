<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasCustomMedia;

    /**
     * Attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'instructor',
        'duration',
        'price'
    ];

    /**
     * Casts for attributes.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
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
     * Scope to search courses by title or instructor.
     *
     * Usage: Course::search('term')->get();
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
                  ->orWhere('instructor', 'like', '%' . $term . '%');
            });
        }

        return $query;
    }

    /**
     * Relationship: One course has many ratings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Relationship: Many-to-many relationship between courses and users.
     * Includes pivot field 'status' and timestamps.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

}
