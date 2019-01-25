<?php

namespace App\Policies;

use App\User;
use App\Proposal;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProposalPolicy
{
    use HandlesAuthorization;

    
    /**  */
    public function view_proposal(User $user, Proposal $proposal)
    {
        return $user->is($proposal->owner) || $user->is($proposal->project->owner);
    }

    /**  */
    public function update_proposal(User $user, Proposal $proposal)
    {
        return $user->is($proposal->owner) && $proposal->withdrawn_at == null && $proposal->confirmed_at == null && $proposal->accepted_at == null; 
    }

    /**  */
    public function favorite_proposal(User $user, Proposal $proposal)
    {
        return $user->is($proposal->project->owner); 
    }

    /**  */
    public function withdraw_proposal(User $user, Proposal $proposal)
    {
    	# a proposal can be withdrawn if the proposal was not yet accepted and if the auth user is the owner of the proposal
    	return $user->is($proposal->owner) && $proposal->confirmed_at == null && $proposal->withdrawn_at == null;
    }

    /**  */
    public function toggle_accepted(User $user, Proposal $proposal)
    {
        return $user->is($proposal->project->owner) 
                && $proposal->withdrawn_at == null
                && $proposal->confirmed_at == null 
                && $proposal->project->completed_at == null 
                && (
                    $proposal->project->selected_proposal_id == null 
                    || $proposal->project->selected_proposal_id == $proposal->id
                );
    }

    /**  */
    public function confirm_proposal(User $user, Proposal $proposal)
    {
        return $user->is($proposal->owner) && $proposal->accepted_at != null && $proposal->id == $proposal->project->selected_proposal_id;
    }

    /**  */
    public function dismiss_proposal(User $user, Proposal $proposal)
    {
        # a proposal can be dismissed if the proposal was not yet accepted and confirmed
        return $user->is($proposal->project->owner) && $proposal->accepted_at == null && $proposal->confirmed_at == null;
    }
}
