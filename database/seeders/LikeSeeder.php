<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        Post::all()->each(function ($post) {
            User::inRandomOrder()->take(3)->get()->each(function ($user) use ($post) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            });
        });
    }
}

