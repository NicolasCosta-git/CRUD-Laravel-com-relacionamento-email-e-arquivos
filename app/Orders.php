<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'pizza_id',
    ];

    public function pizzas()
    {
        return $this->belongsTo(Pizzas::class, 'pizza_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
