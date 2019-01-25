<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProjectsController extends Controller
{
    public function show(Project $project)
    {
    	$project->load('proposals','media','owner.projects');

    	$other_projects = $project->owner->projects->where('id', '!=', $project->id)->take(5)->load('feedback');

    	// TODO
    	// if user doesn't have other projects, then load 5 projects from same category
    	
    	return view('projects.show', compact('project','other_projects'));
    }
}
