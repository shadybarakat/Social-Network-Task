<?php

namespace App\Http\Controllers\api\Posts;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Post;

class DeleteController extends Controller
{
    public function __invoke(Post $post)
    {
        $post->delete();

        return ApiResponse::created(
            null,
            'Post deleted successfully'
        );
    }
}
