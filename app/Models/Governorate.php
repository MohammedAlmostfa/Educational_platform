<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model
{
 use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name', 'code'];

    protected $casts = ['name' => 'json'];

    public function user()
    {
        return $this->hasMany(Profile::class);
    }
}

