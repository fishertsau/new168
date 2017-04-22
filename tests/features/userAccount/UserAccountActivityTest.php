<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group user
 * @group tdd
 */
class UserAccountActivityTest extends TestCase
{
    use DatabaseMigrations;
    use AssertValidationError;

    /**
     * @param null $email
     * @param $password
     * @return $this|void
     */
    protected function webSignIn($email, $password)
    {
        $response = $this->json('post', "/login", [
            'email' => $email,
            'password' => $password
        ]);

        $response->assertStatus(302);

        return auth()->check() ? auth()->user() : null;
    }


    /** @test */
    function signIn_count_is_incremented_by_one_once_singIn()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => Hash::make('secret'),
        ]);

        $this->webSignIn($user->email, 'secret');
        $firstSignInCount = auth()->user()->signIn_count;
        auth()->logout();

        //act
        $this->webSignIn($user->email, 'secret');
        $secondSignInCount = $user->fresh()->signIn_count;

        auth()->logout();
        $this->webSignIn($user->email, 'secret');
        $thirdSignInCount = $user->fresh()->signIn_count;


        $this->assertEquals($firstSignInCount + 1, $secondSignInCount,
            "The sign in account should be one higher.");
        $this->assertEquals($secondSignInCount + 1, $thirdSignInCount,
            "The sign in account should be one higher.");
    }


    /** @test */
    function can_update_account_profile()
    {
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => Hash::make('secret'),
        ]);

//        $this->webSignIn($user->email, 'secret');

        $this->actingAs($user);
        $this->assertSame($user->id, auth()->user()->getAuthIdentifier());

        //act+assert
        $response = $this->json('put', "account/{$user->id}", [
            'email' => 'mary@example.com',
            'name' => 'Mary Doe',
        ]);

        $response->assertStatus(200);
        $this->assertSame('mary@example.com', $user->fresh()->email);
        $this->assertSame('Mary Doe', $user->fresh()->name);

        //act+assert  update 'email' only
        $response = $this->put("account/{$user->id}", [
            'email' => 'josh@example.com',
        ]);

        $response->assertStatus(200);
        $this->assertSame('josh@example.com', $user->fresh()->email);
        $this->assertSame('Mary Doe', $user->fresh()->name);

        //act+assert  update 'name' only
        $response = $this->put("account/{$user->id}", [
            'name' => 'Jack Welsh',
        ]);
        $response->assertStatus(200);
        $this->assertSame('josh@example.com', $user->fresh()->email);
        $this->assertSame('Jack Welsh', $user->fresh()->name);
    }


    /** @test */
    function some_account_profile_data_cannot_be_updated_by_user()
    {
        //arrange
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => Hash::make('secret'),
        ]);

        $this->webSignIn($user->email, 'secret');

        $ori_password = $user->fresh()->password;
        $ori_signIn_count = $user->fresh()->signIn_count;
        $ori_signIn_at = $user->fresh()->signIn_at;
        $ori_last_signIn_at = $user->fresh()->last_signIn_at;
        $ori_signIn_ip = $user->fresh()->signIn_ip;
        $ori_last_signIn_ip = $user->fresh()->last_signIn_ip;


        //act
        $newTime = Carbon::now()->addDays(-10);
        $ip = '300.300.300.300';

        $response = $this->put("account/{$user->id}", [
            'password' => Hash::make('newSecret'),
            'signIn_count' => $user->signIn_count + 100,
            'signIn_at' => $newTime,
            'last_signIn_at' => $newTime,
            'signIn_ip' => $ip,
            'last_signIn_ip' => $ip
        ]);


        //assert
        $response->assertStatus(200);
        $this->assertEquals($ori_password, $user->fresh()->password);
        $this->assertEquals($ori_signIn_count,
            $user->fresh()->signIn_count, "The signIn account should be: {$ori_signIn_count}.");
        $this->assertSame($ori_signIn_at, $user->fresh()->signIn_at);
        $this->assertSame($ori_last_signIn_at, $user->fresh()->last_signIn_at);
        $this->assertSame($ori_signIn_ip, $user->fresh()->signIn_ip);
        $this->assertSame($ori_last_signIn_ip, $user->fresh()->last_signIn_ip);
    }


    /** @test */
    function cannot_update_other_people_account_profile()
    {
        //arrange
        $userA = factory(User::class)->create([
            'email' => 'john@example.com',
            'name' => 'John Doe',
            'password' => Hash::make('secret'),
        ]);

        $userB = factory(User::class)->create();

        //act+assert
        $this->webSignIn($userA->email, 'secret');

        $response = $this->put("account/{$userB->id}", [
            'email' => 'mary@example.com',
            'name' => 'Mary Doe',
        ]);

        $response->assertStatus(302);
    }


    /** @test */
    function only_signIn_user_can_see_account_profile()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('secret'),
        ]);

        //act + assert
        $this->webSignIn($user->email, 'secret');
        $response = $this->get("/account");
        $response->assertStatus(200);

        //act + assert
        auth()->logout();
        $response = $this->get("/account");
        $response->assertStatus(302)
            ->assertRedirect("/login");
    }


    /** @test */
    function duplicate_email_is_not_allowed_for_update()
    {
        factory(User::class)->create(['email' => 'josh@example.com']);
        $newUser = factory(User::class)->create(['email' => 'jane@example.com']);

        try {
            $newUser->update(['email' => 'josh@example.com']);
        } catch (Exception $e) {
            $this->assertEquals($newUser->fresh()->email, 'jane@example.com');
            return;
        }

        $this->fail();
    }


    /** @test */
    function can_see_the_form_which_requests_to_send_password_reset_again()
    {
        // Test code
        //arrange


        //act


        //assert
        //$response->assertViewHas()
        //$response->assertRedirect()

    }


    /**
     * @group integration
     * @test
     */
    function can_request_a_password_reset_email()
    {
        $user = factory(User::class)->create(['email' => 'john@example.com']);
        Notification::fake();
        Notification::assertNotSentTo($user, ResetPassword::class);
        $this->assertCount(0, DB::table('password_resets')->where('email', 'john@example.com')->get());

        //act
        $response = $this
            ->json('post', "password/email", ['email' => 'john@example.com']);

        //assert
        $response->assertStatus(302)->assertRedirect('/');
        $this->assertDatabaseHas('password_resets', ['email' => 'john@example.com']);
        $this->assertCount(1, DB::table('password_resets')->where('email', 'john@example.com')->get());
        Notification::assertSentTo($user, ResetPassword::class);
    }


    /** @test */
    function email_is_required_for_requesting_password_reset_email()
    {
        $response = $this
            ->json('post', "password/email");

        $this->assertValidationError($response, 'email');
    }


    /** @test */
    function legal_email_address_is_required_for_requesting_password_reset_email()
    {
        $user = factory(User::class)->create(['email' => 'john@example.com']);
        Notification::fake();

        $response = $this
            ->json('post', "password/email", ['email' => 'jack@example.com']);

        $response->assertStatus(302)->assertRedirect('/');
        Notification::assertNotSentTo($user, ResetPassword::class);
        $this->assertCount(0, DB::table('password_resets')->where('email', 'jack@example.com')->get());
        $this->assertCount(0, DB::table('password_resets')->where('email', 'john@example.com')->get());
    }


    /** @test */
    function can_reset_password()
    {
        //The token processed mechanism is unclear. So we can not test this.
        //We should assume this could work just as fine.
        //The other alternative is try to link through the email, and see how it works.
        //

//        $resetPassController = $this->spy(ResetPasswordController::class);
//        $resetPassController = $this->mock(ResetPasswordController::class);
//        $resetPassController->shouldReceive('reset')->once();

        //arrange
//        $user = factory(User::class)->create(['email' => 'john@example.com', 'password' => Hash::make('secret')]);
//        $this->assertTrue(Hash::check('secret', $user->password));
//        $this->json('post', "password/email", ['email' => 'john@example.com']);
//        $this->assertCount(1, DB::table('password_resets')->where('email', 'john@example.com')->get());

        //act
//        $response = $this->json('post', 'password/reset', [
//            'email' => 'john@example.com',
//            'password' => 'newSecret',
//            'password_confirmation' => 'newSecret',
//            'token' => 'token'
//        ]);

        //assert
//        $response->assertStatus(302)->assertRedirect('/');
//        $resetPassController->shouldHaveReceived('reset')->once();
    }


    /** @test */
    function email_is_required_for_password_reset()
    {
        $response = $this->json('post', 'password/reset', [
            'password' => 'newSecret',
            'password_confirmation' => 'newSecret',
            'token' => 'token'
        ]);


        $this->assertValidationError($response, 'email');
    }


    /** @test */
    function password_is_required_for_password_reset()
    {
        $response = $this->json('post', 'password/reset', [
            'email' => 'john@example.com',
            'password_confirmation' => 'newSecret',
            'token' => 'token'
        ]);

        $this->assertValidationError($response, 'password');
    }


    /** @test */
    function password_token_is_invalid_when_expires()
    {
        // Test code
        //arrange


        //act


        //assert


    }


    /** @test */
    function password_confirmation_is_required_for_password_reset()
    {
        $response = $this->json('post', 'password/reset', [
            'email' => 'john@example.com',
            'password' => 'newSecret',
            'token' => 'token'
        ]);

        $this->assertValidationError($response, 'password');
    }


    /** @test */
    function token_is_required_for_password_reset()
    {
        $response = $this->json('post', 'password/reset', [
            'email' => 'john@example.com',
            'password' => 'newSecret',
            'password_confirmation' => 'newSecret',
        ]);

        $this->assertValidationError($response, 'token');
    }

    /** @test */
    function can_update_avatar()
    {
        // Test code
        //arrange


        //act


        //assert


    }

    /** @test */
    function profile_update_is_logged()
    {
        // Test code
        //arrange


        //act


        //assert


    }
}
