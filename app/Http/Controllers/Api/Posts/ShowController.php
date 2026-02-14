<?php

namespace App\Http\Controllers\api\Posts;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {

        $post = $post->load(['user', 'likes', 'comments.user']);
        return ApiResponse::success([
            'posts' => new PostResource($post),
        ]);
    }
}
