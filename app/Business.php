<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name', 'logo','phone','password','categories_id','information_id','is_review',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'categories_id');
    }
    public function information()
    {
        return $this->belongsTo(Information::class,'information_id');
    }
}
