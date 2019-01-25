<?php

namespace App\Http\Controllers\User;

use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DismissProposalsController extends Controller
{
	/**
	 * Dismiss the proposal
	 * 
	 * @param  Proposal $proposal
	 */
    public function update(Proposal $proposal)
    {
    	$this->authorize('dismiss_proposal', $proposal);

    	$proposal->dismissed_at = now();
    	$proposal->save();

    	$proposal->unfavorite();
    }
}
