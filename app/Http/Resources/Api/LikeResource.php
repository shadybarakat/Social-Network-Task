<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'user'       => new UserResource($this->user),
        ];
    }
}
