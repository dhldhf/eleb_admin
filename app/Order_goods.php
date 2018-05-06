<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_goods extends Model
{
    protected $fillable = [
       'created_at','updated_at',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
