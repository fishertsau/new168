<?php


namespace App\Mailer;


use Illuminate\Mail\Mailer;

class InMemoryInBox extends Mailer
{
    protected $messages;

    public function __construct()
    {
        $this->messages = collect();
    }

    /**
     * @param array|string $view
     * @param array $data
     * @param null $callback
     */
    public function send($view, array $data = [], $callback = null)
    {
        $message = new Message($view, $data);
        $this->messages[] = $message;
        $callback($message);
    }

    public function hasMessageFor($email)
    {
        return $this->messages->contains(function ($message) use ($email) {
            return $message->to == $email;
        });
    }

    public function hasMessageWithSubject($subject)
    {
        return $this->messages->contains(function ($message) use ($subject) {
            return $message->subject == $subject;
        });
    }
}


class Message
{
    public $view;
    public $data;
    public $to;
    public $subject;

    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function to($email)
    {
        $this->to = $email;
        return $this;
    }

    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
}