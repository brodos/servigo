<?php

namespace App;

use App\Traits\Favoritable;
use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use Favoritable;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // protected $indexConfigurator = ProjectIndexConfigurator::class;

    // protected $searchRules = [
    //     ProjectSearchRule::class
    // ];

    // // protected $mapping = [
    //     'properties' => [
    //         'id'            => ['type' => 'integer'],
    //         'user_id'       => ['type' => 'integer'],
    //         'category_id'   => ['type' => 'integer'],
    //         'title'         => ['type' => 'text'],
    //         'desciption'    => ['type' => 'text'],
    //         'start_date'    => [
    //             'type' => 'date',
    //             'format' => 'y-M-d H:m:s'
    //         ],
    //         'end_date'    => [
    //             'type' => 'date',
    //             'format' => 'y-M-d H:m:s'
    //         ],
    //         'published'     => ['type' => 'short'],
    //         'published_at'    => [
    //             'type' => 'date',
    //             'format' => 'y-M-d H:m:s'
    //         ],
    //         'completed_at'    => [
    //             'type' => 'date',
    //             'format' => 'y-M-d H:m:s'
    //         ],
    //         'created_at'    => [
    //             'type' => 'date',
    //             'format' => 'y-M-d H:m:s'
    //         ],
    //         'updated_at'    => [
    //             'type' => 'date',
    //             'format' => 'y-M-d H:m:s'
    //         ]
    //     ],
    // ];



    // public function toSearchableArray()
    // {
    //     return [
    //         'id' => $this->id,
    //         'title' => $this->title,
    //         'description' => $this->description,
    //     ];
    // }
    // protected $with = ['proposals'];
    
    protected $with = ['favorites'];

    protected $appends = ['isFavorited', 'favoritePath'];

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'completed_at',
        'approved_at',
        'start_date',
        'end_date',
    ];

    
    /** CUSTOM ATTRIBUTES */
    /**
     * Retreive the project's selected proposal
     *
     * @return bool
     */
    // public function getSelectedProposalAttribute()
    // {
    //     return $this->proposals()->where('status', config('settings.proposal.selected'))->first() ?? false;
    // }

    /**
     * Retreive the projects winning proposal
     *
     * @return bool
     */
    // public function getWinningProposalAttribute()
    // {
    //     return $this->proposals()->whereIn('status', config('settings.proposal.winner'))->first() ?? false;
    // }

    /**
     * Determine if the project is active
     *
     * @return bool
     */
    // public function getIsActiveAttribute()
    // {
    //     return $this->status == config('settings.project.active');
    // }
    /**
     * Determine if the project is completed
     *
     * @return bool
     */
    public function getIsPublishedAttribute()
    {
        return $this->published_at !== null;
    }

    /**
     * Determine if the project is completed
     *
     * @return bool
     */
    public function getIsCompletedAttribute()
    {
        return $this->completed_at !== null;
    }

    /**
     * Fetch the proposals count
     * 
     * @return integer
     */
    public function getProposalsCountAttribute()
    {
        return $this->proposals->count();
    }

    /**
     * Fetch the unread proposals count
     * 
     * @return integer
     */
    public function getUnreadProposalsCountAttribute()
    {
        return $this->proposals->where('read', 0)->count();
    }

    /**
     * Determine if the project has reviews
     *
     * @return bool
     */
    public function getHasFeedbackAttribute()
    {
        return (bool) $this->feedback->count();
    }

    /**
     * Retreive project owner feedback
     *
     * @return bool
     */
    public function getReceivedFeedbackAttribute()
    {
        return $this->feedback->where('to_user_id', $this->user_id)->first();
    }

    /**
     * Get the endoint for toggling a favorite
     *
     * @return string
     */
    public function getfavoritePathAttribute()
    {
        return route('user-project.favorite', $this);
    }
    

    /** LOCAL SCOPES */
    /**
     * Scope for selecting only the projects for the authenticated user
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeOwned($query)
    {
        return $query->where('user_id', auth()->id());
    }

    /**
     * Scope for selecting only the draft projects
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopeDrafts($query)
    {
        return $query->whereNull('published_at');
    }

    /**
     * Scope for selecting only the projects for the authenticated user
     * 
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNull('published_at')->orderBy('published_at', 'desc');
    }

    /**
     * HELPERS
     */

    public function add_proposal($proposal) 
    {
        $proposal = $this->proposals()->create($proposal);

        // event(new ProjectReceivedNewProposal($proposal));
        
        return $proposal;
    }

    public function fetchProposalFrom(User $user)
    {
        return $this->proposals->where('user_id', $user->id)->first();
    }

    public function hasProposalFrom(User $user)
    {
        return (bool) $this->fetchProposalFrom($user);
    }

    /** 
     * RELATIONSHIPS
     */
    
    /**
     * A project has proposals
     * 
     * @return App\Proposal
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * A project has unread proposals
     * 
     * @return App\Proposal
     */
    public function unreadProposals()
    {
        return $this->proposals()->where('read', 0);
    }

    /**
     * A project has a selected proposal
     * 
     * @return App\Proposal
     */
    public function selected_proposal()
    {
        return $this->hasOne(Proposal::class, 'selected_proposal_id');
    }

    /**
     * A project has an owner
     * 
     * @return App\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * A project has feedback
     * 
     * @return App\Feedback
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }

    /**
     * A project has conversations
     * 
     * @return App\Message
     */
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    /**
     * A project has a category
     * 
     * @return App\Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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
