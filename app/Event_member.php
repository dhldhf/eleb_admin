<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_member extends Model
{
    public function events()
    {
        return $this->belongsTo(Events::class,'events_id');
    }
    public function businesses()
    {
        return $this->belongsTo(Business::class,'member_id');
    }
}
