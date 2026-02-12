<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
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

        return view('posts.show',['post'=>$post]);
    }
}
