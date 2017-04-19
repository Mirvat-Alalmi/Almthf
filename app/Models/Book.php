<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Book extends Model
{
    public $table = "books";

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function roomId()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
