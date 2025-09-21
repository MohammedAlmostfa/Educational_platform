<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasCustomMedia;
    protected $fillable = [
        'title',
        'description',
        'instructor',
        'duration',
        'price'
    ];

    protected $casts = [
        'price' => 'float',
        'duration' => 'integer',
    ];
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['instructor'])) {
            $query->where('instructor', 'like', '%' . $filters['instructor'] . '%');
        }

        return $query;
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class)
                ->withPivot('status')
                ->withTimestamps();
}

}
