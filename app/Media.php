<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['uuid', 'path', 'media_type'];

    protected $hidden = ['id', 'user_id', 'path', 'updated_at'];

    protected $appends = ['asset_path', 'delete_endpoint'];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /** ATTRIBUTES */
    /**
     * A media knows its asset path
     * 
     * @return string asset_path
     */
    public function getAssetPathAttribute()
    {
    	return asset($this->path);
    }
    /**
     * A media knows its asset path
     * 
     * @return string asset_path
     */
    public function getDeleteEndpointAttribute()
    {
        return route('media.destroy', $this);
    }

    /** RELATIONSHIPS */
    /**
     * A media file has an owner
     * 
     * @return App\User
     */
    public function owner()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A media can have multiple projects
     * 
     * @return App\Project
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
