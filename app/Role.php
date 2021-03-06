<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable = [
        'name', 'display_name','description','created_at','updated_at',
    ];
    public function permission()
    {
        return $this->belongsTo(Permission::class,'categories_id');
    }
}
