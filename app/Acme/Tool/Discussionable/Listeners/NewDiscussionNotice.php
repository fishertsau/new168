<?php


namespace Acme\Tool\Discussionable\Listeners;

use App\User;
use Acme\Tool\Discussionable\Models\Discussion;
use Acme\Tool\Discussionable\Events\DiscussionRaised;
use Acme\Tool\Discussionable\Notifications\DeviceDiscussionRaised as DiscussionRaisedNotification;

/**
 * Class NewDiscussionNotice
 * @package Acme\Tool\Discussionable\Listeners
 */
class NewDiscussionNotice
{
    /**
     * @param DiscussionRaised $discussionRaised
     */
    public function handle(DiscussionRaised $discussionRaised)
    {
        $seller = User::findOrFail($discussionRaised->discussion->discussionable->user_id);
        $discussion = Discussion::findOrFail($discussionRaised->discussion->id);
        $seller->notify(new DiscussionRaisedNotification($discussion, $seller));
    }
}