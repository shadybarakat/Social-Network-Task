<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFriendRequestEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->message = 'New Friend Request From: ' . $user->name;
    }

    public function broadcastAs(): string
    {
        return 'new.friend.request';
    }


    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
        ];
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('new-request-channel'),
        ];
    }
}
