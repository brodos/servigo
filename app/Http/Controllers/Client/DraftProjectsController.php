<?php

namespace App\Http\Controllers\Client;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DraftProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::owned()->drafts()->get();
        $statuses = config('settings.project');

        return view('clients.projects.drafts.index', compact('projects','statuses'));
    }
}
