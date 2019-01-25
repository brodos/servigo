<?php

namespace App\Http\Controllers\Contractor;

use App\Project;
use App\Feedback;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompletedProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proposals = Proposal::owned()->with('project')->get();

        $proposals_with_completed_projects = $proposals->filter(function($proposal) {
            if ($proposal->project->isCompleted)
                return true;
        });
        $projects = $proposals_with_completed_projects->map(function($proposal) {
            return $proposal->project;
        })->load('feedback');

        return view('contractors.projects.completed.index', compact('projects','proposals'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if ($project->isCompleted === false)
            abort(404);

        $project->load('feedback');
        
        $proposal = Proposal::owned()->where('project_id', $project->id)->firstOrFail();

        return view('contractors.projects.completed.show', ['project' => $project, 'proposal' => $proposal]);
    }
}
