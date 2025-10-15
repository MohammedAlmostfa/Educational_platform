<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $firstMedia = $this->media->first();

        return [
            'id'          => $this->id ?? '',
            'name'        => $this->name?? '',
            'description' => $this->description ?? '',
            'author'      => $this->author?? '',
            'file'       => $firstMedia ? asset('storage/' . $firstMedia->path) : '',
        ];
    }
}
