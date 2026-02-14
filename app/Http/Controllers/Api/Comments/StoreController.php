<?php

namespace App\Http\Controllers\Api\Comments;

use App\Factories\ApiResponse;
use App\Http\Resources\Api\CommentResource;
use App\Models\Post;
use Illuminate\Http\Request;


class StoreController
{
    public function __invoke(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        return ApiResponse::created(
            new CommentResource($comment->load('user')),
            'Comment added'
        );
    }
}
