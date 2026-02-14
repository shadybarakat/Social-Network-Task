<?php

namespace App\Http\Controllers\api\Posts;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = auth()->user()
            ->posts()
            ->with([
                'user',
                'comments.user',
                'likes.user',
            ])
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
