<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_prize extends Model
{
    protected $fillable = [
        'events_id', 'name','description','created_at','updated_at','member_id',
    ];
    public function events()
    {
        return $this->belongsTo(Events::class,'events_id');
    }
}
