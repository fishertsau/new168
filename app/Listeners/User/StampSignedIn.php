<?php

namespace App\Listeners\User;

use App\Events\User\SignedIn;
use App\Repository\UserRepository;

class StampSignedIn
{
    /**
     * Handle the event.
     *
     * @param  SignedIn $event
     * @param $time
     * @param $ip
     */
    public function handle(SignedIn $event)
    {
        app()->make(UserRepository::class)
            ->stampSignIn($event->user, $event->time, $event->ip);
    }
}
