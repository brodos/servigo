<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    protected $dates = ['read_at', 'created_at', 'updated_at'];

    /** RELATIONSHIPS */
    /**
     * A message belongs to a conversation
     * 
     * @return App\Conversation
     */
	public function conversation() 
    {
    	return $this->belongsTo(Conversation::class);
    }
    /**
     * A message belongs to a user
     * 
     * @return App\User
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
