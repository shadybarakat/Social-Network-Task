<?php

namespace App\Http\Controllers\api\Posts;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Request $request, Post $post)
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

        // Upload profile picture
        if ($request->hasFile('image')) {

            // delete old image (optional but clean)
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request
                ->file('image')
                ->store('posts', 'public');
        }

        $post->update($data);

        return ApiResponse::created(
            new PostResource($post),
            'Post updates successfully'
        );
    }
}
