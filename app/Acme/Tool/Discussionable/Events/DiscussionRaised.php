<?php

namespace Acme\Tool\Discussionable\Events;

use Illuminate\Queue\SerializesModels;
use Acme\Tool\Discussionable\Models\Discussion;

/**
 * Class DiscussionRaised
 * @package Acme\Tool\Discussionable\Events
 */
class DiscussionRaised
{
    use SerializesModels;

    public $discussion;

    /**
     * Create a new event instance.
     *
     * @param Discussion $discussion
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }
}
