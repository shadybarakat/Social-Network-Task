<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $appends = ['avatar'];
    
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

    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->profile_picture
                ? asset('storage/' . $this->profile_picture)
                : asset('images/default-avatar.png')
        );
    }
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

    public function connections()
    {
        return $this->hasMany(Connection::class, 'sender_id')
            ->orWhere('receiver_id', $this->id);
    }

    public function friendRequests()
    {
        return $this->hasMany(Connection::class, 'receiver_id')
            ->Where('status', 'pending');
    }

    public function connectionWith(User $user)
    {
        return $this->connections->first(
            fn($connection) =>
            $connection->sender_id === $user->id || $connection->receiver_id === $user->id
        );
    }


    public function friends()
    {
        return $this->hasMany(Connection::class, 'sender_id')
            ->where('status', 'accepted')
            ->orWhere(function ($q) {
                $q->where('receiver_id', $this->id)
                    ->where('status', 'accepted');
            });
    }

    public function friendsUsers()
    {
        return $this->friends()->with(['sender', 'receiver'])->get()->map(function ($connection) {
            return $connection->sender_id == $this->id
                ? $connection->receiver
                : $connection->sender;
        });
    }
}
