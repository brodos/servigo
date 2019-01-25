<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AcceptProposalsController extends Controller
{
	/**
	 * Add accepted proposal
	 * @param  App\Proposal $proposal
	 * @return Response
	 */
    public function store(Project $project, Proposal $proposal)
    {
    	// authorize the action
    	$this->authorize('toggle_accepted', $proposal);

    	// Add accepted_at timestamp to the Proposal
    	$proposal->accepted_at = now();
    	$proposal->save();

        // checking of another offer was selected before
        if ($proposal->project->selected_proposal_id != null) {
            $proposal->project->selected_proposal->accepted_at = null;
        }

    	// Add the proposal id to the Project selected_proposal_id column
    	$proposal->project->selected_proposal_id = $proposal->id;
    	$proposal->project->save();

    	if (request()->expectsJson())
    		return response([], 204);

    	return redirect()->route('user-project-proposals.show', [$project, $proposal])->with('flash-message', 'Oferta a fost acceptată! Ofertantul va fi notificat în cel mai scurt timp posibil.');
    }

    /**
     * Remove accepted proposal
     * @param  App\Proposal $proposal
     * @return Response
     */
    public function update(Project $project, Proposal $proposal)
    {
    	// authorize the action
    	$this->authorize('toggle_accepted', $proposal);

    	// Add accepted_at timestamp to the Proposal
    	$proposal->accepted_at = NULL;
    	$proposal->save();

    	// Add the proposal id to the Project selected_proposal_id column
    	$proposal->project->selected_proposal_id = NULL;
    	$proposal->project->save();

    	if (request()->expectsJson())
    		return response([], 204);

    	return redirect()->route('user-project-proposals.show', [$project, $proposal])->with('flash-message', 'Acceptul pentru oferta acceptată a fost anulat.');
    }
}
