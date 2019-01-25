<?php

namespace App\Http\Controllers\Contractor;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OngoingProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = Proposal::owned()->with('project')->get();

        $proposals_with_ongoing_projects = $proposals->filter(function($proposal) {
            if ($proposal->project->isOngoing)
                return true;
        });
        $projects = $proposals_with_ongoing_projects->map(function($proposal) {
            return $proposal->project;
        });

        return view('contractors.projects.ongoing.index', compact('projects','proposals'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
    	$proposal = Proposal::owned()->with('project')->where('project_id', $project->id)->firstOrFail();

    	if ($proposal->project->isOngoing === false)
    		abort(404);

        return view('contractors.projects.ongoing.show', ['project' => $proposal->project, 'proposal' => $proposal]);
    }
}
