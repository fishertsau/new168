<?php

use App\User;
use App\Events\User\UserEmailChanged;
use App\Events\User\ConfirmationEmailRequested;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 * @group user
 */
class UserAccountAuthTest extends TestCase
{
    use RegisterAccount;
    use DatabaseMigrations;


    private $registerParams = [
        'email' => 'john@example.com',
        'name' => 'John Doe',
        'password' => 'secret',
        'password_confirmation' => 'secret',
        'agreed' => true
    ];

    /** @test */
    function unverified_when_initially_registered()
    {
        $response = $this->registerAccount($this->registerParams);

        $response->assertStatus(302);
        $this->assertTrue(auth()->check());
        $this->assertFalse(auth()->user()->verified(),
            "The account should be unverified by default.");
        $this->assertNotNull(auth()->user()->verified_token, "There should be verified token.");
    }


    /** @test */
    function become_unverified_when_email_changed()
    {
        $user = factory(User::class)->create([
            'email' => 'johnWelsh@example.com',
            'verified' => true,
            'verified_token' => null]);
        $this->assertTrue($user->fresh()->verified);

        //update email
        $user->update(['email' => 'mary@example.com']);

        $this->assertFalse($user->fresh()->verified(), "The account should be unverified.");
        $this->assertNotNull($user->fresh()->verified_token, "The account should have verified token.");
    }


    /** @test */
    function the_system_should_be_notified_when_account_email_changed()
    {
        User::all()->each(function ($user) {
            $user->delete();
        });

        Event::fake();
        Event::assertNotDispatched(UserEmailChanged::class);

        $user = factory(User::class)->create(['email' => 'johnLynch@example.com']);

        $user->update(['email' => 'maryDoe@example.com']);

        Event::assertDispatched(UserEmailChanged::class, function ($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }


    /** @test */
    function account_verified_when_validation_link_in_email_hit()
    {
        $user = factory(User::class)->create();
        $this->assertFalse($user->verified());
        $this->assertNotNull($user->verified_token);

        $response = $this->get("email/confirm/{$user->verified_token}");

        $response->assertStatus(302)
            ->assertRedirect('/');
        $this->assertTrue($user->fresh()->verified());
        $this->assertNull($user->fresh()->verified_token);
    }


    /** @test */
    function account_verify_failed_when_invalid_token_provided()
    {
        $user = factory(User::class)->create();
        $this->assertFalse($user->verified());
        $this->assertNotNull($user->verified_token);


        $response = $this->json('get', "email/confirm/invalidToken");

        $response->assertStatus(302)
            ->assertRedirect('/');
        $this->assertFalse($user->fresh()->verified());
        $this->assertNotNull($user->verified_token);
    }


    /** @test
     * @group emailConfirmation
     */
    function notify_system_when_send_a_confirmation_email_request_is_given()
    {
        $this->disableExceptionHandling();

        Event::fake();
        Event::assertNotDispatched(ConfirmationEmailRequested::class);

        $user = factory(User::class)->create();
        $this->post('email/confirm', ['email' => $user->email]);

        Event::assertDispatched(ConfirmationEmailRequested::class, function ($e) use ($user) {
            return $e->user->id = $user->id;
        });
    }


    /** @test
     * @group emailConfirmation
     */
    function a_verified_account_can_not_request_to_send_confirmation_email()
    {
        Event::fake();

        $user = factory(User::class)->create(['verified' => true]);
        $response = $this->post('email/confirm', ['email' => $user->email]);

        $response->assertStatus(302);
        Event::assertNotDispatched(ConfirmationEmailRequested::class);
    }


    /** @test */
    function email_is_required_to_ask_for_a_confirmationEmail()
    {
        $response = $this->post('email/confirm');

        $response->assertStatus(302);
    }
}