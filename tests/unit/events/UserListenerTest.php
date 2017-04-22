<?php


namespace Tests\unit\events;

use Mockery;
use App\User;
use Carbon\Carbon;
use App\Events\User\SignedIn;
use App\Repository\UserRepository;
use App\Listeners\User\WelcomeEmail;
use App\Listeners\User\StampSignedIn;
use App\Events\User\UserEmailChanged;
use Illuminate\Auth\Events\Registered;
use App\Listeners\User\ConfirmationEmail;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 */
class UserListenerTest extends \TestCase
{
    use DatabaseMigrations;


    /** @test */
    function WelcomeEmail_listener()
    {
        $user = factory(User::class)->make(['email' => 'john@example.com']);

        app()->make(WelcomeEmail::class)->handle(new Registered($user));

        $this->assertTrue($this->mailer->hasMessageFor('john@example.com'));
        $this->assertTrue($this->mailer->hasMessageWithSubject('歡迎註冊成為我們的會員!'));
    }


    /** @test */
    function ConfirmationEmail_listener()
    {
        $user = factory(User::class)->create(['email' => 'jack@example.com']);

        app()->make(ConfirmationEmail::class)->handle(new UserEmailChanged($user));

        $this->assertTrue($this->mailer->hasMessageFor('jack@example.com'));
        $this->assertTrue($this->mailer->hasMessageWithSubject('金豪買:電子信箱認證'));
    }


    /** @test */
    function StampSignedIn_listener()
    {
        $userRepo = $this->spy(UserRepository::class);

        $user = factory(User::class)->create();
        $now = Carbon::now();
        $loginIp = '127.0.0.1';

        //act
        (new StampSignedIn($now, $loginIp))->handle(new SignedIn($user,$now,$loginIp));

        $userRepo->shouldHaveReceived('stampSignIn')
            ->once()->with($user, $now, $loginIp);
    }
}