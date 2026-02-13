<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class createController extends Controller
{
    public function __invoke(Post $post)
    {
        return view('posts.create');
    }
}
