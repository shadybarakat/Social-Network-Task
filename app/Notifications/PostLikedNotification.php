<?php

namespace App\Notifications;

use App\Models\User;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class PostLikedNotification extends Notification implements ShouldBroadcastNow
{
    use Queueable;

    protected $sender;
    protected $post;

    public function __construct(User $sender, Post $post)
    {
        $this->sender = $sender;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->sender->id,
            'name' => $this->sender->name,
            'post_id' => $this->post->id,
            'message' => $this->sender->name . ' liked your post.',
            'url' => '/posts/' . $this->post->id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'user_id' => $this->sender->id,
            'name' => $this->sender->name,
            'post_id' => $this->post->id,
            'message' => $this->sender->name . ' liked your post.',
            'url' => '/posts/' . $this->post->id,
        ]);
    }

    public function broadcastOn()
    {
        return ['public-user.' . $this->post->user_id];
    }

    public function broadcastAs()
    {
        return 'post.liked';
    }
}
