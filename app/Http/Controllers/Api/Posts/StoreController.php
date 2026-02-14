<?php

namespace App\Http\Controllers\api\Posts;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'content' => 'required|min:3',
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        // Upload post picture
        if ($request->hasFile('image')) {
            $data['image'] = $request
                ->file('image')
                ->store('posts', 'public');
        }

        $post = auth()->user()->posts()->create($data);

        return ApiResponse::created(
            new PostResource($post),
            'Post created successfully'
        );
    }
}
