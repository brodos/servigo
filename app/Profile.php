<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];

    /**
     * Get the profile location
     *
     * @return string
     */
    public function getLocationAttribute()
    {
    	$location['city'] = $this->city ? $this->city->name : 'Fără localitate';
    	$location['county'] = $this->county ? $this->county->name : 'Fără județ';

    	return implode(', ', $location);
    }

    public function completedPercentage()
    {
    	$percentages = config('settings.profilePercentages');
  		// 'name' => 25
  		// 'avatar' => 10,
  		// 'location' => 15,
		// 'bio' => 25,
		// 'tagline' => 20,
		// 'url' => 5,

    	$completed = [
    		'name' => $this->display_name ? $percentages['name'] : 0,
    		'avatar' => $this->avatar !== null ? $percentages['avatar'] : 0,
    		'location' => $this->city !== null ? $percentages['location'] : 0,
    		'bio' => $this->bio !== null ? $percentages['bio'] : 0,
    		'tagline' => $this->tagline !== null ? $percentages['tagline'] : 0,
    		'url' => $this->slug_name !== null ? $percentages['url'] : 0,
            'media' => $this->media->isNotEmpty() ? $percentages['media'] : 0,
    	];

    	return array_sum($completed);
    }

    /** COUNTY RELATIONSHIP */
    public function county()
    {
    	return $this->belongsTo(County::class);
    }

    /** CITY RELATIONSHIP */
    public function city()
    {
    	return $this->belongsTo(City::class);
    }

    /** USER RELATIONSHIP */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** USER RELATIONSHIP */
    public function media()
    {
        return $this->belongsToMany(Media::class, 'media_profile', 'user_id')->withTimestamps();
    }
}
