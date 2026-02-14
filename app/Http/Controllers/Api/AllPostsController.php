<?php

namespace App\Http\Controllers\Api;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;

class AllPostsController  extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()
            ->posts()
            ->with(['user', 'likes', 'comments.user'])
            ->latest()
            ->paginate(10);

        return ApiResponse::success([
            'posts' => PostResource::collection($posts),
            'meta'  => [
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
            ]
        ]);
    }
}
