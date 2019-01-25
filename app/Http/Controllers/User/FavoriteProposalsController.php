<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteProposalsController extends Controller
{
	/**
     *	Display a listing of the users favorited proposals for this project
     * 
     * @param  App\Project  $project
     * @return Illuminate\Http\Response
     */
    public function index(Project $project)
    {
    	$this->authorize('update_project', $project);

        $all_proposals = $project->proposals()
                            ->active()
                            ->orderby('confirmed_at', 'desc')
                            ->orderby('accepted_at', 'desc')
                            ->orderby('submitted_at', 'desc')
                            ->get()
                            ->load('conversation.messages','owner.profile.county', 'owner.profile.city');

        $proposals = $all_proposals->filter(function($proposal) {
            return $proposal->isFavorited;
        });

    	return view('account.projects.favorites.index', compact('project', 'proposals'));
    }

    /**
     * Store a new favorite in the database.
     *
     * @param  Proposal $proposal
     */
    public function store(Proposal $proposal)
    {
        $this->authorize('favorite_proposal', $proposal);

        $proposal->favorite();
    }

    /**
     * Remove a favorite from database
     * 
     * @param  Proposal $proposal
     */
    public function destroy(Proposal $proposal)
    {
        $this->authorize('favorite_proposal', $proposal);

        $proposal->unfavorite();
    }
}
