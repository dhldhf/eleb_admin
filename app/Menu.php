<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name', 'sort','address','created_at','updated_at','superior','parent_id',
    ];
}
