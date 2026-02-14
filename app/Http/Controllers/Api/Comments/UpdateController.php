<?php

namespace App\Http\Controllers\Api\Comments;

use App\Factories\ApiResponse;
use App\Http\Resources\Api\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;


class UpdateController
{
    public function __invoke(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => ['required', 'string'],
        ]);

        $comment->update($validated);

        return ApiResponse::success(
            new CommentResource($comment->load('user')),
            'Comment updated'
        );
    }
}
