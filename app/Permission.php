<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    

    /** RELATIONSHIPS */
    public function roles()
    {
    	return $this->belongsToMany(Role::class);
    }
}
