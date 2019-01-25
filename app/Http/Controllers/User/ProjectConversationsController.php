<?php

namespace App\Http\Controllers\User;

use App\Project;
use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectConversationsController extends Controller
{
    /**
     *	Display a listing of project conversations
     * 
     * @param  App\Project  $project
     * @return Illuminate\Http\Response
     */
    public function index(Project $project)
    {
    	$this->authorize('update_project', $project);

        $conversations = $project->conversations()->get()->load('messages');

        $conversations = $conversations->filter(function($conversation) {
            return $conversation->messages->isNotEmpty();
        });

        $conversations->load('proposal.owner', 'unreadMessages');

        // return $conversations;

    	return view('account.projects.conversations.index', compact('project', 'conversations'));
    }

    public function show(Project $project, Conversation $conversation)
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

        return view('account.projects.conversations.show', compact('project','conversation'));
    }
}
