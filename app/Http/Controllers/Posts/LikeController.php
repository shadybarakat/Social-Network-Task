<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Notifications\PostLikedNotification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __invoke(Post $post)
    {
        $user = auth()->user();
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
            if ($post->user_id !== $user->id) { 
                $post->user->notify(new PostLikedNotification($user, $post));
            }
        }

        return response()->json([
            'likes_count' => $post->likes()->count(),
            'liked' => $liked
        ]);
    }
}
