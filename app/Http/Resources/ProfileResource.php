<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'birthday' => $this->profile->birthday,
            'phone' => $this->profile->phone,
            'address' => $this->profile->address,
            'governorate_id' => $this->governorate_id,
        ];
    }
}
