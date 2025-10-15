<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id ?? '',
            'email'           => $this->email ?? '',
            'name'            => $this->name ?? '',
            'phone'           => $this->profile?->phone ?? '',
            'address'         => $this->profile?->address ?? '',
            'governorate_name'=> $this->profile?->governorate?->name ?? '',
        ];
    }
}
