<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{

	public $timestamps = false;

    /**
     * RELATIONSHIPS
     */
    /**
     * A county has many cities
     * 
     * @return App\City
     */
    public function cities()
    {
    	return $this->hasMany(City::class)->orderBy('name');
    }
}
