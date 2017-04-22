<?php

namespace App\Listeners\User;


use App\Mailer\UserMailer;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail implements ShouldQueue
{
    public $mailer;
    public $event;


    /**
     * Create the event listener.
     *
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     */
    public function handle(Registered $event)
    {
        $this->mailer->welcome($event->user);
        return true;
    }
}
