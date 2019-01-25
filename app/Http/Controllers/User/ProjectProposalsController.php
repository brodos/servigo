<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectProposalsController extends Controller
{

    public function index(Project $project)
    {
    	$this->authorize('update_project', $project);

        $project->load('conversations.messages');

        $proposals = $project->proposals()
                            ->active()
                            ->orderby('confirmed_at', 'desc')
                            ->orderby('accepted_at', 'desc')
                            ->orderby('submitted_at', 'desc')
                            ->get()
                            ->load('conversation.messages','owner.profile.county', 'owner.profile.city');
    	
    	return view('account.projects.proposals.index', compact('project', 'proposals'));
    }

    public function show(Project $project, Proposal $proposal)
    {
    	$this->authorize('view_proposal', $proposal);

        $proposal->load('conversation.messages','owner.profile');

        // mark proposal as read
        if ($proposal->read_at == null) {
            $proposal->read_at = now();
            $proposal->save();
        }

        return view('account.projects.proposals.show', compact('project','proposal'));
    }
}
