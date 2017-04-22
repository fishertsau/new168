<?php

namespace Tests\Browser\UserAccount;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use App\Repository\UserRepository;
use Tests\Browser\Pages\UserAccount\Account;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\UserAccount\SendEmailVerification;


/**
 * @group browser
 * @group UserAccount
 * @group UserAccountValidation
 *
 * */
class UserAccountValidationBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     * @return void
     */
    public function main()
    {
        $this->browse(function ($browser) {

            //arrange
            $user = factory(User::class)->create([
                'email' => 'john@example.com',
                'name' => 'John Doe'
            ]);


            $this->can_ask_for_resending_email_confirmation($browser, $user);
            $this->not_allowed_to_resend_email_confirmation_without_complete_info($browser);
            $this->resend_request_not_allowed_for_verified_user($browser, $user);

            //unverified notice
            $this->can_see_verified_notice_at_account_profile($browser);

            //email validation
            $this->a_validation_success_msg_shown_when_verified_successfully($browser, $user);
            $this->validation_failed_if_no_correct_info_provided($browser, $user);
        });
    }


    private function not_allowed_to_resend_email_confirmation_without_complete_info($browser)
    {
        //illegal email
        $browser->visit(new SendEmailVerification)
            ->sendRequest('crazy@example.com')
            ->assertWrongEmail()
            ->on(new SendEmailVerification);

        //no email
        $browser->visit(new SendEmailVerification)
            ->sendRequest()
            ->on(new SendEmailVerification);
    }


    private function resend_request_not_allowed_for_verified_user(Browser $browser, $user)
    {
        (new UserRepository)->verify($user);
        $browser->visit(new HomePage)
            ->visit(new SendEmailVerification)
            ->sendRequest($user->email);

        $browser->assertAccountVerifiedNotNecessary()
            ->on(new HomePage);


        //signed-in user  visits "email/verification"
        $browser->loginAs($user)
            ->visit($currentPage = new HomePage)
            ->visit('/email/verification');
        $browser->on($currentPage);

        $browser->visit($currentPage = new Account($user))
            ->visit('/email/verification');
        $browser->on($currentPage);

        $this->userLogout($browser);
    }


    private function can_see_verified_notice_at_account_profile(Browser $browser)
    {
        //unVerified user
        //see unverified notice
        //see resend button
        //push button -> (1)see notice, (2)page don't change

        //verified user
        // don't see unverified notice
        // don't see resend button
        // visit 'email/verification' -> redirect back
    }


    private function can_ask_for_resending_email_confirmation(Browser $browser, $user)
    {
        (new UserRepository)->unverify($user);

        $browser->visit(new SendEmailVerification)
            ->sendRequest($user->email)
            ->assertEmailConfirmationResent()
            ->on(new HomePage);
    }


    /**
     * @group verification
     */
    function an_email_confirmation_notice_is_pupped_up_after_email_changed()
    {
        // Test code
        //arrange


        //act
        //user change email

        //assert
        //should see .modal as reminding
    }


    /**
     * @param Browser $browser
     * @param $user
     */
    function a_validation_success_msg_shown_when_verified_successfully(Browser $browser, $user)
    {
        (new UserRepository)->unverify($user);

        //act
        $browser->visit("/email/confirm/" . $user->verified_token);

        //assert
        (new SendEmailVerification)->assertAccountVerified($browser);
        $this->assertTrue($user->fresh()->verified);

        //after
        $this->userLogout($browser);
    }


    private function validation_failed_if_no_correct_info_provided(Browser $browser, $user)
    {
        (new UserRepository)->unverify($user);

        //act
        $browser->visit("/email/confirm/invalidToken");

        //assert
        (new SendEmailVerification)->assertAccountVerificationFailed($browser);

        //tear down
        $this->userLogout($browser);
    }
}