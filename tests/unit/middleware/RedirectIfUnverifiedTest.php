<?php

use App\User;
use Mockery as m;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfUnverified;

/**
 * Class ModelOwnerTest
 * @group middleware
 * @group tdd
 */
class RedirectIfUnverifiedTest extends TestCase
{
    /**
     * Handle an incoming request.
     * @test
     */
    public function allow_verified_user()
    {
        $this->actingAs(factory(User::class)
            ->states('verified')->make());

        $request = m::mock(Request::class);

        $nextParam = null;

        $next = function ($param) use (&$nextParam) {
            $nextParam = $param;
        };

        (new RedirectIfUnverified())->handle($request, $next);

        $this->assertSame($request, $nextParam);
    }

    /** @test */
    function not_allow_unverified_user()
    {
        $this->actingAs(factory(User::class)->states('unverified')->make());

        $request = m::mock(Request::class);
        $next = function (){};

        $response = (new RedirectIfUnverified())->handle($request, $next);

        $this->assertTrue($response instanceof RedirectResponse);
    }
}
