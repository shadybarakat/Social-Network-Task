<?php

namespace App\Http\Controllers\API;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'required|string|max:255',
        ]);

        $query = $request->input('q');

        $users = User::where('name', 'like', "%{$query}%")
                     ->orWhere('email', 'like', "%{$query}%")
                     ->paginate(10);

        return ApiResponse::success([
            'users' => UserResource::collection($users),
            'meta'  => [
                'current_page' => $users->currentPage(),
                'last_page'    => $users->lastPage(),
            ]
        ]);
    }
}
