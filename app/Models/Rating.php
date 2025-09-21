<?php

namespace App\Models;

use App\Policies\RatingPolicy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
#[UsePolicy(RatingPolicy::class)]
class Rating extends Model
{
protected $fillable = ['user_id', 'course_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
