<?php

namespace App\Http\Controllers\Client;

use App\Message;
use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function store(Project $project)
    {
        $this->validate(request(), [
            'message' => 'required|min:1|max:5000',
        ]);

        Message::create([
        	'from_user_id' => auth()->user()->id,
        	'to_user_id' => $project->winningProposal->user_id,
        	'project_id' => $project->id,
        	'message' => request()->message,
        	'sent_at' => Carbon::now()
        ]);

        return redirect()->route('client-projects.show', $project->id);
    }
}
