<?php

namespace App\Http\Controllers\User;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteProjectsController extends Controller
{
    /**
     * Store a new favorite in the database.
     *
     * @param  Project $project
     */
    public function store(Project $project)
    {
        $project->favorite();
    }

    /**
     * Remove a favorite from database
     * 
     * @param  Project $project
     */
    public function destroy(Project $project)
    {
        $project->unfavorite();
    }
}
