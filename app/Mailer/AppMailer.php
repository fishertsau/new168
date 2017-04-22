<?php


namespace App\Mailer;

use Illuminate\Mail\Mailer;

use App;
use App\User;

/**
 * Class Mailer
 * @package App\Mailer
 */
abstract class AppMailer
{
    private $mailer;

    /**
     * AppMailer constructor.
     * @param Mailer $mailer
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * @param User $user
     * @param $subject
     * @param $view
     * @param array $data
     * @return bool
     */
    public function sendTo(User $user, $subject, $view, $data = [])
    {
        $this->mailer->send($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)
                ->subject($subject);
        });
    }
}