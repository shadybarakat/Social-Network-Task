<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'content'    => $this->content,
            'created_at' => $this->created_at?->toISOString(),
            'user'       => new UserResource($this->user),
            'is_owner'   => auth()->check() && $this->user_id === auth()->id(),
        ];
    }
}
