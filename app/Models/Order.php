<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Order extends Model
{
    public $table = "orders";

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function meals()
    {
        return $this->belongsToMany(Meal::class, 'order_meal');
    }

    public function doneId()
    {
        return $this->belongsTo(Done::class);
    }


}
