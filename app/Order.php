<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'orders';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function pizzas() {
        return $this->belongsToMany('App\Pizza', "pizza_orders", 'orders_id', 'pizzas_id')->withPivot('count');
    }
}
