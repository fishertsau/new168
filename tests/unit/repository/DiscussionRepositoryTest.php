<?php

use Acme\Tool\Discussionable\Events\DiscussionRaised;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Acme\Tool\Discussionable\DiscussionabilityTrait;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group discussion
 * @group tdd
 */
class DiscussionRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $discussionRepo;

    protected function setUp()
    {
        parent::setUp();
        Schema::create('testModels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dummy');
            $table->timestamps();
        });

        $this->discussionRepo = App::make(\App\Repository\DiscussionRepository::class);
    }

    /** @test */
    function can_raise_a_discussion()
    {
        $model = RepositoryDiscussionableModel::create(['dummy' => 'dummy']);
        $user = factory(User::class)->create();

        $discussion = $this->discussionRepo->raiseFor(
            $model, $user, 'a discussion content'
        );

        $this->assertSame($discussion->discussionable_id, $model->id);
        $this->assertSame($discussion->discussionable_type, get_class($model));
        $this->assertSame($discussion->user_id, $user->id);
        $this->assertSame($discussion->content, 'a discussion content');
    }

    /** @test */
    function can_cease_a_discussion()
    {
        $model = RepositoryDiscussionableModel::create(['dummy' => 'dummy']);
        $user = factory(User::class)->create();

        $discussion = $model->discussions()->create([
            'user_id' => $user->id,
            'content' => 'some content'
        ]);

        $this->assertEquals('some content', $discussion->fresh()->content);

        $this->discussionRepo->cease($discussion);

        $this->assertNull($discussion->fresh());
    }

    /** @test */
    function an_event_is_fired_when_a_discussion_raised()
    {
        Event::fake();

        $model = RepositoryDiscussionableModel::create(['dummy' => 'dummy']);
        $user = factory(User::class)->create();

        $discussion = $this->discussionRepo->raiseFor($model, $user, 'a discussion content');

        Event::assertDispatched(DiscussionRaised::class, function ($e) use ($discussion) {
            return $e->discussion->id === $discussion->id;
        });
    }
}


class RepositoryDiscussionableModel extends Model implements \Acme\Tool\Discussionable\Discussionable
{
    use DiscussionabilityTrait;

    protected $table = 'testModels';
    protected $guarded = [];
}

class RepositoryNonDiscussionableModel extends Model
{
    protected $table = 'testModels';
    protected $guarded = [];
}

