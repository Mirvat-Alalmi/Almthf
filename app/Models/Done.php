<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Done extends Model
{
    public $table = "dones";

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
