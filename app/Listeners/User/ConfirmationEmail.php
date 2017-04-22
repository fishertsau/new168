<?php

namespace App\Listeners\User;

use App\Mailer\UserMailer;
use App\Events\User\UserEmailChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmationEmail implements ShouldQueue
{
    private $userMailer;

    /**
     * ConfirmationEmail constructor.
     * @param $userMailer
     */
    public function __construct(UserMailer $userMailer)
    {
        $this->userMailer = $userMailer;
    }


    /**
     * Handle the event.
     *
     * @param  UserEmailChanged $event
     * @return void
     */
    public function handle(UserEmailChanged $event)
    {
        $this->userMailer->emailConfirmation($event->user);
    }
}
