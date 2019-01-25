<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public $timestamps = false;

    public $hidden = ['region','siruta'];

    /**
     * RELATIONSHIPS
     */
    /**
     * A city belongs to a county
     * 
     * @return App\County
     */
    public function county()
    {
    	return $this->belongsTo(County::class);
    }
}
