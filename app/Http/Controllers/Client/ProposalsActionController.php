<?php

namespace App\Http\Controllers\Client;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ProposalsActionController extends Controller
{
	public function __construct()
    {   
        $this->middleware('auth');
    }
    
    /**
     * Accept / select the received proposal
     * @param  Project  $project  App\Project
     * @param  Proposal $proposal App\Proposal
     * @return string
     */
    public function accept(Project $project, Proposal $proposal)    
    {
        // check if the current proposal status accepts the accept/select action
        if (! in_array($proposal->status, config('settings.proposal.allow_select'))) {
            return 'nu putem accepta aceasta oferta [status: ' . $proposal->status . ']';
        }

        // check if project status is allowing for accepted proposals
        if ( $project->status != config('settings.project.active')) {
            return 'acest proiect are deja o oferta acceptata [status: ' . $project->status . ']';
        }

        // set the new proposal status
        $proposal->status = config('settings.proposal.selected');
        $proposal->save();

        // set the new project status
        $project->status = config('settings.project.selected');
        $project->save();
        
        return 'oferta acceptata';
    }

    /**
     * Save the selected proposal
     * @param  Project  $project  App\Project
     * @param  Proposal $proposal App\Proposal
     * @return string             
     */
    public function save(Project $project, Proposal $proposal)
    {
        // check if the current proposal status accepts the save/unsave action
        if (! in_array($proposal->status, config('settings.proposal.allow_save'))) {
            return 'nu putem salva aceasta oferta [status: ' . $proposal->status . ']';
        }

        // toggle the proposal status
        $proposal->status = ($proposal->status == config('settings.proposal.submitted')) ? config('settings.proposal.saved') : config('settings.proposal.submitted');
        $proposal->save();

        return 'proiectul a fost ' . ($proposal->status == config('settings.proposal.saved') ? 'salvat in' : 'scos din') . ' favorite';
    }

    /**
     * Dismiss the selected proposal
     * @param  Project  $project  App\Project
     * @param  Proposal $proposal App\Proposal
     * @return string
     */
    public function dismiss(Project $project, Proposal $proposal)
    {   
        // check if the current proposal status accepts the dismiss action
        if (! in_array($proposal->status, config('settings.proposal.allow_dismiss'))) {
            return 'nu putem elimina un proiect castigator [status: ' . $proposal->status . ']';
        }

        // if the proposal was in the selected status we need to reset the project status back to active
        if ($proposal->status == config('settings.proposal.selected')) {
            $project->status = config('settings.project.active');
            $project->save();
        }
        
        // set the new proposal status
        $proposal->status = config('settings.proposal.dismissed');
        $proposal->save();
        
        return 'proposal dismissed';
    }

    /**
     * Toggle the proposal as read/unread
     * @param  Project  $project  App\Project
     * @param  Proposal $proposal App\Proposal
     * @return string             
     */
    public function read(Project $project, Proposal $proposal)
    {
        $proposal->read_at = $proposal->read == 0 ? Carbon::now() : null;
        $proposal->read = $proposal->read == 0 ? 1 : 0;
        $proposal->save();

        return 'oferta a fost marcata ca ' . ($proposal->read == 1 ? 'citita' : 'necitita');
    }
}