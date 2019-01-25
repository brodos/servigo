<?php

namespace App\Http\Controllers\User;

use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WithdrawProposalsController extends Controller
{
    /**
	 * Withdraw a proposal
	 * 
	 * @param  Proposal $proposal
	 */
    public function update(Proposal $proposal)
    {
    	$this->authorize('withdraw_proposal', $proposal);

    	$proposal->withdrawn_at = now();
    	
        if ($proposal->accepted_at != null) {
            $proposal->accepted_at = null;
            $proposal->project->selected_proposal_id = null;
        }

        $proposal->save();
        $proposal->project->save();

    	$proposal->unfavorite();

        if (request()->expectsJson())
            return response([], 204);

        return redirect()->route('user-proposal.show', $proposal)->with('flash-message', 'Oferta a fost retrasă!');
    }
}
