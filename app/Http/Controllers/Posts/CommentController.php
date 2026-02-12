<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __invoke(Request $request, Post $post)
    {
        $request->validate(['content' => 'required|min:1']);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return response()->json([
            'content' => $comment->content,
            'user_name' => $comment->user->name
        ]);
    }
}
