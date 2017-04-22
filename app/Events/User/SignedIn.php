<?php

namespace App\Events\User;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class SignedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $time;
    public $ip;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param $time
     * @param $ip
     */
    public function __construct(User $user, $time, $ip)
    {
        $this->user = $user;
        $this->time = $time;
        $this->ip = $ip;
    }
}
