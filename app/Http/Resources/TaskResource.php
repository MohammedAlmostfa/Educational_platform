<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $firstMedia = $this->media->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'deadline_date' => $this->deadline_date,
            'created_ats' => $this->created_at  ? \Carbon\Carbon::parse($this->created_at)->format('Y-m-d ')
                : null,
            'updated_at' => $this->updated_at  ? \Carbon\Carbon::parse($this->updated_at)->format('Y-m-d ')
                : null,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,

            'file'       => $firstMedia ? asset('storage/' . $firstMedia->path) : null,

        ];
    }
}
