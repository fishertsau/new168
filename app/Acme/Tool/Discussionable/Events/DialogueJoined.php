<?php


namespace Acme\Tool\Discussionable\Events;

use Illuminate\Queue\SerializesModels;
use Acme\Tool\Discussionable\Models\Dialogue;


/**
 * Class DialogueJoined
 * @package Acme\Tool\Discussionable\Events
 */
class DialogueJoined
{
    use SerializesModels;

    public $dialogue;

    /**
     * DialogueJoined constructor.
     * @param $dialogue
     */
    public function __construct(Dialogue $dialogue)
    {
        $this->dialogue = $dialogue;
    }
}