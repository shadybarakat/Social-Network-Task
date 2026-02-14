<?php

namespace App\Http\Controllers;

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
            ->orWhere('username', 'like', "%{$query}%")
            ->with('connections')
            ->paginate(10);

        return view('users.search', [
            'users' => $users,
            'query' => $query
        ]);
    }
}
