<?php

namespace App\Http\Controllers\api\Posts;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|min:3',
        ]);


        $post->update([
            'content' => $request->content,
        ]);

        return ApiResponse::created(
            new PostResource($post),
            'Post updates successfully'
        );
    }
}
