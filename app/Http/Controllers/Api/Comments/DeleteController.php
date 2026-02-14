<?php

namespace App\Http\Controllers\Api\Comments;

use App\Factories\ApiResponse;
use App\Models\Comment;

class DeleteController
{
    public function __invoke(Comment $comment)
    {
        $comment->delete();

        return ApiResponse::success(null, 'Comment deleted');
    }
}