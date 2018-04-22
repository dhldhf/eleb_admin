<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'bao', 'zhun', 'fengniao', 'on_time', 'piao', 'brand','shop_name', 'shop_img', 'shop_rating', 'service_code', 'foods_code', 'high_or_now', 'h_l_percent','brand', 'start_send', 'send_cost', 'distance', 'estimate_time', 'notice', 'discount','evaluate','user_id', 'username', 'user_img','evaluate_code','evaluate_details','time',
    ];
}
