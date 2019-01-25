<?php

namespace App\Listeners;

use App\Events\ProposalWasAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyProposalOwner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProposalWasAccepted  $event
     * @return void
     */
    public function handle(ProposalWasAccepted $event)
    {
        //
    }
}
