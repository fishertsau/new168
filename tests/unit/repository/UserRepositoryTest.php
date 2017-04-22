<?php

use App\User;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 */
class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $userRepo;

    protected function setUp()
    {
        parent::setUp();

        $this->userRepo = new UserRepository;
    }


    /** @test */
    function can_create_user()
    {
        $user = $this->userRepo->createUser([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret'
        ]);

        $this->assertEquals($user->name, 'John Doe');
        $this->assertEquals($user->email, 'john@example.com');
        $this->assertTrue(Hash::check('secret', $user->password));
    }

    /** @test */
    function can_find_user_by_email()
    {
        $user = factory(User::class)->create(['email' => 'john@example.com']);

        $this->assertEquals($user->id, $this->userRepo->findByEmail('john@example.com')->id);
    }


    /** @test */
    function can_find_user_by_attribute()
    {
        $user = factory(User::class)->create();

        //act+assert
        $foundUser = $this->userRepo->findUserByAttribute('name', $user->name);
        $this->assertEquals($user->id, $foundUser->id);

        //act+assert
        $foundUser = $this->userRepo->findUserByAttribute('email', $user->email);
        $this->assertEquals($user->id, $foundUser->id);

        //act+asset
        try {
            $foundUser = $this->userRepo->findUserByAttribute('strangeAttribute', $user->name);
            $this->assertEquals($user->id, $foundUser->id);
        } catch (Exception $e) {
            return;
        }

        $this->fail();
    }


    /** @test */
    function can_confirm_email_verification()
    {
        //arrange
        $user = factory(User::class)->create();
        $this->assertFalse($user->verified);
        $this->assertNotNull($user->verified_token);

        //act
        $this->userRepo->confirmEmail($user->verified_token);

        //assert
        $this->assertTrue($user->fresh()->verified, "The account should be verified.");
        $this->assertNull($user->fresh()->verified_token, "The verified token should be null.");
    }

    /** @test */
    function can_unverify_account()
    {
        //arrange
        $user = factory(User::class)->create();
        $this->userRepo->confirmEmail($user->verified_token);
        $this->assertTrue($user->fresh()->verified, "The account should be verified.");
        $this->assertNull($user->fresh()->verified_token, "The verified token should be null.");

        $this->userRepo->verify($user);

        //act
        $this->userRepo->unverify($user);
        $this->userRepo->verify($user);
        $this->userRepo->unverify($user);

        //assert
        $this->assertFalse($user->fresh()->verified, "The account should be verified.");
        $this->assertNotNull($user->fresh()->verified_token, "The verified token should be null.");
    }

    /** @test */
    function can_verify_account()
    {
        //arrange
        $user = factory(User::class)->create();
        $this->assertFalse($user->fresh()->verified, "The account should be unverified.");
        $this->assertNotNull($user->fresh()->verified_token, "The verified token should not be null.");

        //act
        $this->userRepo->verify($user);

        //assert
        $this->assertTrue($user->fresh()->verified, "The account should be verified.");
        $this->assertNull($user->fresh()->verified_token, "The verified token should be null.");
    }


    /** @test */
    function can_stamp_signIn()
    {
        $user = factory(User::class)->create([
            'signIn_at' => Carbon::now()->addDays(-3), //3 days ago
            'signIn_ip' => '0.0.0.0',
        ]);

        $oldSignIn_count = $user->signIn_count;
        $oldSingIn_at = $user->signIn_at;
        $oldSignIn_ip = $user->signIn_ip;


        $now = Carbon::now();
        $loginIp = '127.0.0.1';

        //act
        $this->userRepo->stampSignIn($user, $now, $loginIp);

        //assert
        $this->assertSame($oldSignIn_count + 1, $user->signIn_count,
            "The correct login count should be 1 higher than {$oldSignIn_count}.");
        $this->assertEquals($oldSignIn_count + 1, $user->signIn_count,
            "The correct login count should be 1 higher than {$oldSignIn_count}.");

        $this->assertEquals($now, $user->signIn_at);
        $this->assertSame($oldSingIn_at, $user->last_signIn_at);

        $this->assertSame($loginIp, $user->signIn_ip);
        $this->assertSame($oldSignIn_ip, $user->last_signIn_ip);
    }

    /** @test */
    function can_create_at_most_one_vendor()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        //act + assert
        $vendor = $this->userRepo->createOrUpdateVendor($user, [
            'type' => '個人',
            'title' => 'A vendor'
        ]);

        $this->assertEquals($vendor->title, 'A vendor');
        $this->assertEquals($vendor->user->id, $user->id);
        $this->assertNotNull($user->fresh()->vendor, "Should be able to get a vendor.");
        $this->assertEquals($user->fresh()->vendor->id, $vendor->id);


        //act + assert
        $newVendor = $this->userRepo->createOrUpdateVendor($user, [
            'title' => 'A brand new vendor'
        ]);

        $this->assertEquals($newVendor->title, 'A brand new vendor');
        $this->assertEquals($newVendor->user->id, $user->id);
        $this->assertEquals($newVendor->id, $vendor->id);
    }
}
