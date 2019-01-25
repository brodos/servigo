<?php

namespace App;

use App\Traits\Favoritable;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use Favoritable;

    protected $fillable = [
        'uuid', 
        'user_id', 
        'project_id', 
        'price', 
        'description', 
        'duration', 
        'duration_type', 
        'available_from',
    ];

    protected $with = ['favorites'];

    protected $appends = ['isFavorited', 'favoritePath', 'dismissPath', 'withdrawPath'];

    // Casted dates to Carbon
    protected $dates = ['created_at', 'updated_at', 'available_from', 'submitted_at', 'read_at', 'accepted_at', 'confirmed_at', 'dismissed_at', 'withdrawn_at'];

    
    /**
     * Set the key used by route binding
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }


    /** CUSTOM ATTRIBUTES */
  	/**
     * Get the endoint for toggling a favorite
     *
     * @return string
     */
    public function getfavoritePathAttribute()
    {
        return route('user-proposal.favorite', $this);
    }

    /**
     * Get the endoint for dismissing the proposal
     *
     * @return string
     */
    public function getdismissPathAttribute()
    {
        return route('user-proposal.dismiss', $this);
    }

    /**
     * Get the endoint for withdrawing the proposal
     *
     * @return string
     */
    public function getwithdrawPathAttribute()
    {
        return route('user-proposal.withdraw', $this);
    }

    /** LOCAL SCOPES */
    /**
     * Scope for selecting only the proposals for the authenticated user
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeOwned($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }

    /**
     * Scope for selecting only the proposels marked as confirmed
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeConfirmed($query)
    {
        return $query->whereNotNull('confirmed_at');
    }

    /**
     * Scope for selecting only the non-dismissed proposals
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeNotDismissed($query)
    {
        return $query->whereNull('dismissed_at');
    }

    /**
     * Scope for selecting only the non-withdrawn proposals
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->whereNotNull('submitted_at')->whereNull('withdrawn_at');
    }

    /** RELATIONSHIPS */
    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class);
    }

    /**
     * A project has many media files
     * 
     * @return App\Media
     */
    public function media()
    {
        return $this->belongsToMany(Media::class)->withTimestamps();
    }
}
