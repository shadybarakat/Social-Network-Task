<?php

namespace App\Http\Controllers\Api\Posts;

use App\Factories\ApiResponse;
use App\Models\Post;

class LikeController
{
    public function __invoke(Post $post)
    {
        $user = auth()->user();

        $like = $post->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            $like->delete();

            return ApiResponse::success([
                'liked' => false,
                'likes_count' => $post->likes()->count(),
            ], 'Post unliked');
        }

        $post->likes()->create([
            'user_id' => $user->id,
        ]);

        return ApiResponse::success([
            'liked' => true,
            'likes_count' => $post->likes()->count(),
        ], 'Post liked');
    }
}
