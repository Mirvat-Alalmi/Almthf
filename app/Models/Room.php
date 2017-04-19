<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $table = "rooms";

    public function roomTypeId()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    public function books()
    {
        return $this->belongsTo(Book::class);
    }
}
