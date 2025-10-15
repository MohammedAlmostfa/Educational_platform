<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $firstMedia = $this->media?->first();

        return [
            'id'            => $this->id ?? '',
            'title'         => $this->title ?? '',
            'description'   => $this->description ?? '',
            'instructor'    => $this->instructor ?? '',
            'duration'      => $this->duration ?? '',
            'price'         => $this->price ?? '',
            'averageRating' => $this->ratings_avg_rating !== null
                ? (float) $this->ratings_avg_rating
                : null,
            'photo'         => $firstMedia
                ? asset('storage/' . $firstMedia->path)
                : null,
            'tasks'   => TaskResource::collection($this->whenLoaded('tasks')),
            'ratings' => RatingResource::collection($this->whenLoaded('ratings')),
            'videos'  => VideoResource::collection($this->whenLoaded('videos')),
        ];
    }
}
