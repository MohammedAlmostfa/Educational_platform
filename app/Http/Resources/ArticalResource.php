<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $firstMedia = $this->media->first();

        return [
            'id'           => $this->id ?? '',
            'title'        => $this->title ?? '',
            'content'      => $this->content ?? '',
            'author'       => $this->author ?? '',
            'published_at' => $this->published_at
                ? Carbon::parse($this->published_at)->format('Y-m-d')
                : '',
            'photo'        => $firstMedia
                ? asset('storage/' . $firstMedia->path)
                : '',
        ];
    }
}
