<?php

namespace App\Http\Controllers\Connections;

use App\Http\Controllers\Controller;

class FriendsRequestsController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();
        $requests = $user->friendRequests()
            ->with(['sender', 'sender.connections']) 
            ->get();
            
        return view('connections.requests', compact('requests'));
    }
}
