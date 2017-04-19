<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    public $table = "food_types";

    public function meals()
    {
        return $this->hasMany(Meal::class, 'food_type_id');
    }
}
