<?php

use Acme\Tool\Ownable\Ownable;
use App\User;
use Illuminate\Http\Request;
use App\Http\Middleware\ModelOwner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Model;
use Mockery as m;


/**
 * Class ModelOwnerTest
 * @group middleware
 * @group tdd
 */
class ModelOwnerTest extends TestCase
{
    use \Illuminate\Foundation\Testing\DatabaseMigrations;

    /** @test */
    function model_owner()
    {
        $this->markTestSkipped('The Testing code should be reviewed again.');
        $u = factory(User::class)
            ->states('verified')->create();

        $request = m::mock(Request::class);

        $nextParam = null;

        $next = function ($param) use (&$nextParam) {
            $nextParam = $param;
        };

        $ownableModel = new TestModel($u);

        $this->app->singleton('testModel', function () use ($ownableModel) {
            return $ownableModel;
        });

        $this->actingAs($u);

        //act
        (new ModelOwner)->handle($request, $next, 'testModel', 1);

        $this->assertSame($request, $nextParam);
    }


    /** @test */
    function not_allow_if_not_model_owner()
    {
        $this->markTestSkipped('The Testing code should be reviewed again.');

        $u = factory(User::class)
            ->states('verified')->create();

        $request = m::mock(Request::class);

        $next = function () {
        };

        $ownableModel = new TestModel(factory(User::class)->states('verified')->create());

        $this->app->singleton('testModel', function () use ($ownableModel) {
            return $ownableModel;
        });

        $this->actingAs($u);

        //act
        $response = (new ModelOwner)->handle($request, $next, 'testModel', 1);

        $this->assertTrue($response instanceof RedirectResponse);
    }
}


class TestModel extends Model implements Ownable
{
    /**
     * @var User
     */
    private $user;

    /**
     * TestModel constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function ownedBy(\App\User $user)
    {
        return $this->user->id === auth()->user()->id;
    }

    public function findOrFail($id)
    {
        return $this;
    }
}

