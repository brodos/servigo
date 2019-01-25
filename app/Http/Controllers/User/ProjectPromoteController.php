<?php

namespace App\Http\Controllers\User;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectPromoteController extends Controller
{
    /**
     *	Display the promoting options for this project
     * 
     * @param  App\Project  $project
     * @return Illuminate\Http\Response
     */
    public function show(Project $project)
    {
    	$this->authorize('update', $project);

    	return view('account.projects.promote.show', compact('project'));
    }
}
