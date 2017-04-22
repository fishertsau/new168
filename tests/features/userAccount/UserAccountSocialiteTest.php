<?php

use App\User;
use App\Events\User\SignedIn;
use Acme\Auth\SocialiteGateway;
use App\Repository\UserRepository;
use Acme\Auth\FakeSocialiteGateway;
use Illuminate\Foundation\Testing\DatabaseMigrations;
/**
 * @group tdd
 */
class UserAccountSocialiteTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp()
    {
        parent::setUp();
        $this->app->instance(SocialiteGateway::class, new FakeSocialiteGateway);
    }


    private function fakeFBUser()
    {
        return factory(User::class)->make([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => 'secret'
        ]);
    }


    /** @test */
    function can_register_with_FB_account()
    {
        Event::fake();
        Event::assertNotDispatched(SignedIn::class);

        $user = $this->fakeFBUser();

        //act
        $this->json('get', "/auth/socialite/callback/{$this->makeObjJson($user)}");

        //assert
        $registeredUser = User::first();
        $this->assertTrue(auth()->check());
        $this->assertNotNull($registeredUser, "There should be on user created.");
        $this->assertEquals($user->name, $registeredUser->name);
        $this->assertEquals($user->email, $registeredUser->email);

        Event::assertDispatched(SignedIn::class, function ($e) use ($registeredUser) {
            return $e->user->id === $registeredUser->id;
        });
    }

    /** @test */
    function can_login_with_FB_if_already_registered()
    {
        Event::fake();
        Event::assertNotDispatched(SignedIn::class);

        $user = $this->fakeFBUser();
        $this->json('get', "/auth/socialite/callback/{$this->makeObjJson($user)}");
        auth()->logout();

        //act
        $this->json('get', "/auth/socialite/callback/{$this->makeObjJson($user)}");

        //assert
        $foundUser = UserRepository::findByEmail('john@example.com');
        $this->assertTrue(auth()->check());
        $this->assertCount(1, User::all());
        $this->assertEquals(auth()->user()->name, $foundUser->name);
        $this->assertEquals(auth()->user()->email, $foundUser->email);

        Event::assertDispatched(SignedIn::class, function ($e) use ($foundUser) {
            return $e->user->id === $foundUser->id;
        });
    }
}
