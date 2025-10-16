<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes ,HasCustomMedia ;


protected $fillable = [
    'title',
    'description',
    'user_id',
    'course_id',
    'date',
    'certificate_number',
];




    /**
     * Relations
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relation with Media
     */
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }


}
