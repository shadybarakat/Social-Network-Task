<?php

namespace App\Http\Controllers\Connections;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;

class SendController extends Controller
{
    public function __invoke(User $user)
    {
        $authUser = auth()->user();

        if ($authUser->id == $user->id) {
            return response()->json(['error' => 'Cannot add yourself'], 400);
        }

        $exists = Connection::where(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $authUser->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $authUser->id);
        })->exists();

        if ($exists) {
            return response()->json(['error' => 'Request exists'], 400);
        }

        Connection::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id,
        ]);

        return response()->json(['success' => 'Request sent!']);
    }
}
