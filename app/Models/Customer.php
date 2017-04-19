<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Customer extends Model
{
    public $table = "customers";

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
