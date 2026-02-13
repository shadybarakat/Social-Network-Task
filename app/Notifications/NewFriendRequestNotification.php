<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class NewFriendRequestNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    protected $sender;
    public $reciver;
    public function __construct(User $sender)
    {
        $this->sender = $sender;
    }

    public function via($notifiable)
    {
        $this->reciver = $notifiable;
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'id' => $this->sender->id,
            'name' => $this->sender->name,
            'message' => 'New Friend Request From: ' . $this->sender->name,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user_id' => $this->sender->id,
            'name' => $this->sender->name,
            'message' => 'New Friend Request From: ' . $this->sender->name,
        ]);
    }

    public function broadcastOn()
    {
        return ['public-user.' . $this->reciver->id];
    }

    public function broadcastAs()
    {
        return 'new.friend.request';
    }
}
