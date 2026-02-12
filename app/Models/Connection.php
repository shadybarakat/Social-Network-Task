<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Friends
    public function friends()
    {
        return Connection::where(function ($q) {
            $q->where('sender_id', $this->id)
                ->orWhere('receiver_id', $this->id);
        })->where('status', 'accepted');
    }
}
