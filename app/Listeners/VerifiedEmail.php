<?php

namespace App\Listeners;

use App\User;
use Illuminate\Support\Facades\Lang;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifiedEmail
{

    protected $user = null;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        return session()->flash('flash-message', Lang::getFromJson('Email address was succesfully verified.'));
    }
}
