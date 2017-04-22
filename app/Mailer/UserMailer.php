<?php


namespace App\Mailer;

use App\User;

/**
 * Class UserMailer
 * @package App\Mailer
 */
class UserMailer extends AppMailer
{
    /**
     * @param User $user
     * @return bool
     */
    public function emailConfirmation(User $user)
    {
        $view = 'emails.emailConfirmation';
        $subject = '金豪買:電子信箱認證';

        return $this->sendTo($user, $subject, $view, compact('user'));
    }

    /**
     * @param User $user
     * @return bool
     */
    public function welcome(User $user)
    {
        $view = 'emails.welcome';
        $data = $user;
        $subject = '歡迎註冊成為我們的會員!';

        return $this->sendTo($user, $subject, $view, compact('user'));
    }
}