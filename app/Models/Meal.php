<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    public $table = "meals";

    public function foodTypeId()
    {
        return $this->belongsTo(FoodType::class, 'food_type_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_meal');
    }
}
