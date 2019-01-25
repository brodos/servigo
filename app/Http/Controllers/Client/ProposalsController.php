<?php

namespace App\Http\Controllers\Client;

use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalsController extends Controller
{
    public function show(Project $project, Proposal $proposal)
    {
        return 'show proposal ' . $proposal->id . ' for project ' . $project->id;
    }
}
