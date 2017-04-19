<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    public $table = "room_types";

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_type_id');
    }
}
