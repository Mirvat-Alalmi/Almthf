<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id');

    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'user_id');
    }

    public function suggs()
    {
        return $this->hasMany(Sugg::class, 'user_id');
    }

}