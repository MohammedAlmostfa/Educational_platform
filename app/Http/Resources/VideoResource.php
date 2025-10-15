<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id ?? '',
            'course_id'  => $this->model_id ?? '',
            'path'       => $this->path
                ? asset('storage/' . $this->path)
                : null,
            'mime_type'  => $this->mime_type ?? '',
        ];
    }
}
