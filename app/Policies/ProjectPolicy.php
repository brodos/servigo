<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function create_proposal(?User $user, Project $project)
    {
    	// we need to check if a proposal from the same user exists for this project
    	if ($user)
    		return $user->id != $project->user_id && $project->published_at !== null && $project->approved_at !== null && $project->completed_at === null && $user->submittedProposal($project) === null;
    	else
    		return $project->published_at !== null && $project->approved_at !== null && $project->completed_at === null;
    }

    public function update_project(User $user, Project $project)
    {
        return $user->is($project->owner); 
    }
}
