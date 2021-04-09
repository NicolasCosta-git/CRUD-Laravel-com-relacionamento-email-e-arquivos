<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{
    protected $fillable = [
        'client_id',
        'pizza_id',
    ];

    public function pizzas(){
        return $this->belongsTo(Pizzas::class,'pizza_id');
    }
    public function clients(){
        return $this->belongsTo(Clients::class,'client_id');
    }
}
