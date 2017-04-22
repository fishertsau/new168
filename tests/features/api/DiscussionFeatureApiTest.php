<?php


use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Acme\Tool\Discussionable\Discussionable;
use Acme\Tool\Discussionable\Models\Discussion;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class DiscussionFeatureApiTest
 * @group discussion
 * @group tdd
 * ＠group api
 */
class DiscussionFeatureApiTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;
    protected $model;

    function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        Schema::create('discussionableModels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dummy');
            $table->timestamps();
        });

        $this->model = DiscussionableModel::create(['dummy' => '']);
    }

    private function tokenHeaderUrl($url, $user)
    {
        $token = JWTAuth::fromUser($user);
        return $url . '?token=' . $token;
    }

    /** @test */
    function an_signIn_user_can_raise_discussion_regarding_a_model()
    {
        $this->actingAs($this->user);
        $content = "I want to raise a discussion.  Here is the content";

        $response = $this->json(
            'post',
            $this->tokenHeaderUrl(
                'api/discussions/' . get_class($this->model) . '/' . $this->model->id, $this->user),
            ['content' => $content]
        );

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'a discussion created'
            ]);
        $this->assertArrayHasKey('discussion', $response->json());
        $this->assertSame($content, $response->json()['discussion']['content']);

        $discussion = Discussion::first();
        $this->assertSame($content, $discussion->content);
        $this->assertSame(get_class($this->model), $discussion->discussionable_type);
        $this->assertEquals($this->user->id, $discussion->user_id);
    }

    /** @test */
    function content_is_required_to_raise_discussion()
    {
        $this->actingAs($this->user);

        $response = $this->json(
            'post',
            $this->tokenHeaderUrl(
                'api/discussions/' . get_class($this->model) . '/' . $this->model->id, $this->user),
            ['content' => '']
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('content', $response->json());

        $this->assertNull(Discussion::first());
    }

    /** @test */
    function only_the_signIn_user_is_allowed_to_raise_a_discussion()
    {
        $response = $this->json(
            'post',
            $this->tokenHeaderUrl(
                'api/discussions/' . get_class($this->model) . '/' . $this->model->id, $this->user),
            ['content' => '']
        );

        $response->assertStatus(422);
        $this->assertArrayHasKey('content', $response->json());

        $this->assertNull(Discussion::first());
    }




    /** @test */
    function an_account_can_cease_discussion()
    {
        $this->actingAs($this->user);
        $discussion = $this->model->discussions()->create([
            'user_id' => $this->user->id,
            'content' => 'content'
        ]);
        $this->assertTrue($discussion->ownedBy($this->user));

        $response = $this->json(
            'delete',
            $this->tokenHeaderUrl(
                'api/discussions/' . $discussion->id, $this->user));

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'a discussion is ceased.'
            ]);

        $this->assertNull($discussion->fresh());
    }

    /** @test */
    function only_owner_can_cease_the_discussion()
    {
        $discussion = $this->model->discussions()->create([
            'user_id' => $this->user->id,
            'content' => 'some content'
        ]);

        $this->actingAs($newUser = factory(User::class)->create());

        $response = $this->json(
            'delete',
            $this->tokenHeaderUrl(
                'api/discussions/' . $discussion->id, $newUser));

        $response->assertStatus(500)
            ->assertJson([
                'status' => 'failed',
                'message' => 'not the owner'
            ]);

        $this->assertEquals('some content', $discussion->fresh()->content);
    }
}


class DiscussionableModel extends Model implements Discussionable
{
    protected $guarded = [];
    protected $table = 'discussionableModels';
    use \Acme\Tool\Discussionable\DiscussionabilityTrait;
}
