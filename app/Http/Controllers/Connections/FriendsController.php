<?php

namespace App\Http\Controllers\Connections;

use App\Http\Controllers\Controller;
use App\Models\Connection;

class FriendsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $friends = $user->friendsUsers();

        return view('connections.friends', compact('friends'));
    }
}
