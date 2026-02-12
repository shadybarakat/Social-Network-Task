<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with([
            'user',
            'likes',
            'comments.user',
        ])
            ->latest()
            ->paginate(10);

        $connections = auth()->user()
            ->connections()
            ->get()
            ->keyBy(function ($c) {
                return $c->sender_id === auth()->id()
                    ? $c->receiver_id
                    : $c->sender_id;
            });

        return view('homepage', compact('posts', 'connections'));
    }
}
