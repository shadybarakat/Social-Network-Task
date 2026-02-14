<?php

namespace App\Http\Controllers\Api;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProfileApiUpdateRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileApiController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return ApiResponse::success([
            'user' => new UserResource($user),
        ]);
    }

    public function update(ProfileApiUpdateRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        // Upload profile picture
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $data['profile_picture'] = $request
                ->file('profile_picture')
                ->store('profiles', 'public');
        }

        $user->update($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        return ApiResponse::created([
            'posts' => new UserResource($user),
            'Profile updated  successfully'
        ]);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        return ApiResponse::created([
            'posts' => new UserResource($user),
            'Profile deleted successfully'
        ]);
    }
}
