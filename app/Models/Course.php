<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasCustomMedia;

    /**
     *  The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',        // Course title
        'description',  // Course description
        'instructor',   // Instructor's name
        'duration',     // Duration in hours or minutes
        'price',        // Course price
    ];

    /**
     * 🧮 Attribute casting definitions.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
    ];

    // ----------------------------------------------------------
    // 🔹 Polymorphic Relationships with Media
    // ----------------------------------------------------------

    /**
     * Polymorphic relationship: Get all image-type media related to the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     *
     * 📘 Note:
     * - Only returns media with a MIME type starting with 'image/'.
     * - Requires the `mime_type` column to be stored in the `media` table.
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model')
                    ->where('mime_type', 'like', 'image/%');
    }

    /**
     * Polymorphic relationship: Get all video-type media related to the course.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     *
     * 📘 Note:
     * - Only returns media with a MIME type starting with 'video/'.
     * - Useful for embedding video lessons or promotional clips.
     */
    public function videos()
    {
        return $this->morphMany(Media::class, 'model')
                    ->where('mime_type', 'like', 'video/%');
    }

    // ----------------------------------------------------------
    // 🔹 Scopes
    // ----------------------------------------------------------

    /**
     * Local scope for searching courses by title or instructor name.
     *
     * Example:
     * ```php
     * Course::search('Programming')->get();
     * ```
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

    // ----------------------------------------------------------
    // 🔹 Relationships
    // ----------------------------------------------------------

    /**
     * One-to-many relationship:
     * A course can have multiple ratings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Many-to-many relationship:
     * A course can have multiple enrolled users, and each user can join multiple courses.
     * Includes a pivot column `status` and timestamps.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('status')
                    ->withTimestamps();
    }

    /**
     * One-to-many relationship:
     * A course can have multiple tasks or assignments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
