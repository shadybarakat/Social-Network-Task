<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'profile_picture',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /* ========= Relations ========= */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Friend requests I sent
    public function sentConnections()
    {
        return $this->hasMany(Connection::class, 'sender_id');
    }

    // Friend requests I received
    public function receivedConnections()
    {
        return $this->hasMany(Connection::class, 'receiver_id');
    }

    public function getAvatarAttribute(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }

        return asset('images/default-avatar.png');
    }

    public function connections()
    {
        return $this->hasMany(Connection::class, 'sender_id')
            ->orWhere('receiver_id', $this->id);
    }

    public function friends()
    {
        $connections = Connection::where(function ($q) {
            $q->where('sender_id', $this->id)
                ->orWhere('receiver_id', $this->id);
        })->where('status', 'accepted')->get();

        $friends = $connections->map(function ($connection) {
            return $connection->sender_id == $this->id
                ? $connection->receiver
                : $connection->sender;
        });

        return $friends;
    }
}
