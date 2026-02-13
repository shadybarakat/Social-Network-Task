<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
public function __invoke(Request $request, Post $post)
{
    $data = $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $comment = $post->comments()->create([
        'user_id' => auth()->id(),
        'content' => $data['content'],
    ]);

    return response()->json([
        'id' => $comment->id,
        'content' => $comment->content,
        'user' => [
            'id' => $comment->user->id,
            'name' => $comment->user->name,
            'profile_url' => route('users.profile', $comment->user),
        ],
    ]);
}

}
