<?php

namespace App\Http\Controllers\Api\Connections;

use App\Factories\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ConnectionResource;
use App\Models\Connection;
use App\Models\User;
use App\Notifications\NewFriendRequestNotification;

class SendController extends Controller
{
    public function __invoke(User $user)
    {
        $authUser = auth()->user();

        $exists = Connection::where(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $authUser->id)->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authUser, $user) {
            $q->where('sender_id', $user->id)->where('receiver_id', $authUser->id);
        })->exists();

        if ($exists) {
            throw new \Exception('Request already exist');
        }

        $connection = Connection::create([
            'sender_id' => $authUser->id,
            'receiver_id' => $user->id,
        ]);

        //notification
        $user->notify(new NewFriendRequestNotification($authUser));

        return ApiResponse::created(
            new ConnectionResource($connection),
            'Friend request sent'
        );
    }
}
