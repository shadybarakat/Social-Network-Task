<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'content'   => $this->content,
            'created_at' => $this->created_at?->toISOString(),
            'author'    => new UserResource($this->whenLoaded('user')),
            'likes'     => LikeResource::collection($this->whenLoaded('likes')),
            'comments'  => CommentResource::collection($this->whenLoaded('comments')),
            'is_liked'  => auth()->check()
                ? $this->likes->where('user_id', auth()->id())->isNotEmpty()
                : false,
        ];
    }
}
