<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'phone', 'password', 'uuid', 'terms_accepted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $with = ['roles'];
    
    /** ATTRIBUTES */
    public function getDisplayNameAttribute()
    {
        $display_name = $this->profile->display_name;
        
        if (! $display_name) {
            $display_name = explode('@', $this->email)[0];
        }

        return $display_name;
    }
    

    /** HELPERS */
    public function assignRole (Role $role)
    {
        return $this->roles()->attach($role);
    }

    public function removeRole (Role $role)
    {
        return $this->roles()->dettach($role);
    }

    public function hasRole ($roles)
    {
        if (is_string($roles)) {
            return $this->roles->contains('name', $roles);
        }

        return (bool) $roles->intersect($this->roles)->count();
    }

    public function displayRoles ()
    {
        return $this->roles->implode('name', ', ');
    }

    public function avatar()
    {
        $avatar = asset($this->profile->avatar);

        if (! $this->profile->avatar) {
            $avatar = sprintf('http://www.gravatar.com/avatar/%s?d=%s&s=%d&r=%s', md5( $this->email ), 'identicon', '128', 'pg');
        }

        return $avatar;
    }

    public function submittedProposal(Project $project)
    {
        return $this->proposals()->where('project_id', $project->id)->first();
    }

    /** RELATIONSHIPS */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function conversations()
    {
        return $this->belongsToMany(Conversation::class)->latest('updated_at');
    }

    function media() 
    {
        return $this->hasMany(Media::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }
}