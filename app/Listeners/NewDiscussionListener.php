<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Acme\Tool\Discussionable\Events\DiscussionRaised;

class NewDiscussionListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }


    public function handle(DiscussionRaised $event)
    {

    }
}
