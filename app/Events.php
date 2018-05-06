<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'title', 'signup_start','signup_end','created_at','updated_at','prize_date','signup_num','content','is_prize',
    ];
}
