<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|min:3',
        ]);

        $post = auth()->user()->posts()->create($data);

        return view('posts.show', compact('post'));
    }
}
