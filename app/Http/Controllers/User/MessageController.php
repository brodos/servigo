<?php

namespace App\Http\Controllers\User;

use App\Conversation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function store(Conversation $conversation)
    {
    	$this->authorize('update_conversation', $conversation);

    	$this->validate(request(), [
    		'message' => 'required'
    	]);

    	$conversation->messages()->create([
    		'body' => request()->message,
    		'user_id' => auth()->id(),
    	]);

        // Touch parent timestamp
        $conversation->updated_at = now();
        $conversation->save();

    	// fire some event
        
        if (request()->has('return_to')) {
            return redirect(request('return_to'));            
        }

    	return redirect()->route('user-conversation.show', $conversation);
    }
}
