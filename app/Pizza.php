<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    public $table = 'pizzas';
    public $timestamps = false;

    public function orders() {
        return $this->belongsToMany('App\Order', "pizza_orders", 'pizzas_id', 'orders_id')->withPivot('count');
    }
}
