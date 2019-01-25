<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $guarded = ['id'];

    public $timestamps = false;

    public $dates = ['created_at', 'replied_at'];




    /** CUSTOM ATTRIBUTES */
    
    // /**
    //  * Scope for selecting only the feedbacks I received
    //  * 
    //  * @param Builder $query
    //  * @return Builder
    //  */
    // public function scopeReceived($query)
    // {
    //     return $query->where('to_user_id', auth()->user()->id);
    // }

    // /**
    //  * Scope for selecting only the feedbacks I gave
    //  * 
    //  * @param Builder $query
    //  * @return Builder
    //  */
    // public function scopeGiven($query)
    // {
    //     return $query->where('from_user_id', auth()->user()->id);
    // }
}
