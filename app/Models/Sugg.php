<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Sugg extends Model
{
    public $table = "suggs";

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
