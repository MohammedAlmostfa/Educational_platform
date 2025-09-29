<?php

namespace App\Models;
use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasCustomMedia;
    protected $fillable = ['course_id', 'title', 'deadline_date','start_time','end_time', 'description'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Polymorphic relationship for associated media files.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
