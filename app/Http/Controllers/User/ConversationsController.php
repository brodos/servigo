<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\Proposal;
use App\Conversation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConversationsController extends Controller
{
	/**
	 * Display the conversasions list
	 * 
	 * @return Response $response
	 */
    public function index()
    {
    	$user = auth()->user();
    	
    	$conversations = $user->conversations()->get()->load('messages'); //,

    	$conversations = $conversations->filter(function($conversation) {
    		return $conversation->messages->isNotEmpty();
    	});

        $conversations->load('unreadMessages','project.owner.profile','proposal.owner.profile');

    	return view('account.conversations.index', compact('conversations'));
    }

    public function store($projectuuid, Proposal $proposal)
    {
        $project = Project::where('uuid', $projectuuid)->firstOrFail();

        $this->authorize('update_project', $project);
        $this->authorize('view_proposal', $proposal);
        
        $conversation = $project->conversations()->create([
            'proposal_id' => $proposal->id,
            'uuid' => Str::uuid()
        ]);

        $conversation->addParticipants([$project->user_id, $proposal->user_id]);

        return redirect()->route('user-conversation.show', $conversation);
    }

    public function show(Conversation $conversation)
    {
    	$this->authorize('update_conversation', $conversation);

    	$conversation->load('messages','project.owner','proposal.owner');
    	
    	// mark messages as read
    	$unreadMessages = $conversation->messages->filter(function($message) {
    		return $message->read_at === null && $message->user_id != auth()->id();
    	})->each(function($message) {
    		$message->read_at = now();
    		$message->save();
    	});

    	return view('account.conversations.show', compact('conversation'));
    }
}
