<?php

namespace App\Policies;

use App\User;
use App\Conversation;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    public function update_conversation(User $user, Conversation $conversation)
    {
        return $conversation->participants->contains($user);
    } 
}
