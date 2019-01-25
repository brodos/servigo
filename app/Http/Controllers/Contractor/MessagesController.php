<?php

namespace App\Http\Controllers\Contractor;

use App\Message;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function index()
    {	
    	$message = Message::latest()
    			->with('project')
    			->mine()
    			->first();

    	if ($message)
    		return redirect()->route('contractor-messages.show', $message->project->id);


    	return view('contractors.messages.index', compact('messages','projects'));
    }

    public function show(Project $project)
    {
    	$messages = Message::oldest()
    			->with('project.owner','from','to')
    			->mine()
    			->get();

    	$projects = $messages->map(function ($message) {
    		return $message->project;
    	})->unique();

    	$messages = $messages->groupBy(function ($message) {
    		return $message->project->id;
    	});

    	// dd($project);

    	return view('contractors.messages.show', compact('messages','projects','project'));
    }

    public function store(Project $project)
    {
    	$this->validate(request(), [
            'message' => 'required|min:1|max:5000',
        ]);

        Message::create([
        	'from_user_id' => auth()->user()->id,
        	'to_user_id' => $project->user_id,
        	'project_id' => $project->id,
        	'message' => request()->message,
        	'sent_at' => Carbon::now()
        ]);

        return redirect()->route('contractor-messages.show', $project->id);
    }
}
