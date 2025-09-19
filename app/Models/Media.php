<?php

namespace App\Models;

use App\Traits\HasCustomMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{ use  HasCustomMedia;

    protected $fillable = [
        'model_type',
        'model_id',
        'path',
        'mime_type',
    ];

    public function model()
    {
        return $this->morphTo();
    }
}
