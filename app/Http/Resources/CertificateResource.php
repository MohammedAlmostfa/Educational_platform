<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $firstMedia = $this->media->first();

        return [
            'id'                  => $this->id,
            'title'               => $this->title,
            'description'         => $this->description,
            'user'                => $this->user ? [
                                        'id'   => $this->user->id,
                                        'name' => $this->user->name,
                                    ] : null,
            'course'              => $this->course ? [
                                        'id'   => $this->course->id,
                                        'name' => $this->course->title,
                                    ] : null,
            'date'                => $this->date,
            'certificate_number'  => $this->certificate_number,
            'file'                => $firstMedia ? asset('storage/' . $firstMedia->path) : null,

        ];
    }
}
