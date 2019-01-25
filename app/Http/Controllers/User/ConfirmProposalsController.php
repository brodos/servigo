<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfirmProposalsController extends Controller
{
	/**
	 * Confirm accepted proposal
	 * @param  App\Proposal $proposal
	 * @return Response
	 */
    public function store(Proposal $proposal)
    {
    	// authorize the action
    	$this->authorize('confirm_proposal', $proposal);

    	// Confirm the accepted proposal
    	$proposal->confirmed_at = now();
    	$proposal->save();

    	$proposal->project->completed_at = now();
    	$proposal->project->save();

    	if (request()->expectsJson())
    		return response([], 204);

    	return redirect()->route('user-proposal.show', $proposal)->with('flash-message', 'Oferta a fost confirmată!');
    }    
}
