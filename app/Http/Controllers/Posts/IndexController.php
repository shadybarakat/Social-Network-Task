<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('posts.index', compact('posts'));
    }
}
