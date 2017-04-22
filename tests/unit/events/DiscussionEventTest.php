<?php

namespace Tests\unit\events;

use Acme\Tool\Discussionable\Events\DiscussionRaised;
use Acme\Tool\Discussionable\Models\Discussion;
use App\Listeners\NewDiscussionListener;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 */
class DiscussionEventTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    function DiscussionRaised_event()
    {
        $discussion = factory(Discussion::class)->make();
        event(new DiscussionRaised($discussion));
        $this->assertPushed(NewDiscussionListener::class);
    }
}
