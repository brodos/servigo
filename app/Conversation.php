<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /** HELPERS */
    /**
     * Add participants to a conversation
     * 
     * @param array $participants
     */
    public function addParticipants($participants)
    {
    	return $this->participants()->attach($participants);
    }
    
    public function unreadMessages()
    {
        return $this->hasMany(Message::class)->where('read_at', null)->where('user_id', '<>', auth()->id())->orderBy('created_at', 'asc');
    }

    /** ATTRIBUTES */
    public function getunreadMessagesCountAttribute()
    {
        return $this->unreadMessages->count();
    }

    /** RELATIONSHIPS */
    /**
     * A conversation has more participants
     * 
     * @return App\User
     */
    public function participants()
    {
    	return $this->belongsToMany(User::class, 'conversation_user', 'conversation_id', 'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    /**
     * A project has a conversation
     * 
     * @return App\Project
     */
    public function project()
    {
    	return $this->belongsTo(Project::class);
    }

    /**
     * A proposal has a conversation
     * 
     * @return App\Project
     */
    public function proposal()
    {
    	return $this->belongsTo(Proposal::class);
    }
}
