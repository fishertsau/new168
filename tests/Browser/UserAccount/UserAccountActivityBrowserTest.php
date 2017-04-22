<?php

namespace Tests\Browser\UserAccount;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\UserAccount\Account;
use Tests\Browser\Pages\UserAccount\ForgetPassword;
use Illuminate\Foundation\Testing\DatabaseMigrations;


/**
 * @group browser
 * @group UserAccount
 * @group UserAccountActivity
 *
 * */
class UserAccountActivityBrowserTest extends DuskTestCase
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

            //forget password
            $this->can_ask_for_forget_password_email($browser, $user);
            $this->forget_password_not_allowed_if_no_correct_info_provided($browser);
            $this->forget_password_not_allowed_for_signedIn_user($browser, $user);

            //account profile: (1)see, (2)update, (3)not allowed, (4)enough info
            //signed in user visit account

            //$this->can_do_fb_login_in_this_page($browser);
        });
    }


    private function can_ask_for_forget_password_email(Browser $browser, User $user)
    {
        $browser->visit('http://google.com.tw')
                ->assertSee('Google');


        $browser->visit($currentPage = new ForgetPassword)
            ->sendForgetPasswordRequest($user->email)
            ->assertRequestSucceeded()
            ->on($currentPage);

        $this->userLogout($browser);
    }


    private function forget_password_not_allowed_if_no_correct_info_provided(Browser $browser)
    {
        //wrong email
        $browser->visit($currentPage = new ForgetPassword)
            ->sendForgetPasswordRequest('crazy@example.com')
            ->assertRequestFailed()
            ->on($currentPage);


        //no email
        $browser->visit($currentPage = new ForgetPassword)
            ->sendForgetPasswordRequest()
            ->on($currentPage);
    }


    private function forget_password_not_allowed_for_signedIn_user(Browser $browser, User $user)
    {
        $browser->loginAs($user);

        //sign in user, redirected back
        $browser->visit($currentPage = new HomePage)
            ->visit('/password/reset')
            ->on($currentPage)
            ->visit($currentPage = new Account($user))
            ->visit('/password/reset')
            ->on($currentPage);
    }


    /** @
     * @group account_profile
     */
    function can_update_account_profile()
    {
        // Test code
        //arrange


        //act


        //assert


    }


    /** @
     * @group account_profile
     */
    function can_see_account_profile()
    {
        // Test code
        //arrange


        //act


        //assert


    }


    /** @
     * @group account_profile
     */
    function can_update_avatar()
    {
        // Test code
        //arrange


        //act


        //assert


    }



    /** @
     * @group account_profile
     */
    function redirected_if_not_signIn()
    {
        // Test code
        //arrange


        //act


        //assert
        //redirect to login page

    }


    /** @
     * @group account_profile
     */
    function cannot_see_others_profile()
    {

    }

    /** @
     * @group account_profile
     */
    function cannot_update_others_profile()
    {
        // Test code
        //arrange


        //act


        //assert


    }




    /** @
     * @group reset_password
     * can_see_the_form_for_entering_password_reset
     */
    function can_update_password_through_forget_password_email()
    {
        // Test code
        //arrange


        //act


        //assert
        //correct form is shown
        //redirect to other page when successful
        //check new password matches the entered value

    }



    /** @
     * This part needs to be revisited.
     * Should an user do (1)in-site password change, or  (2)with email account?
     */
    function user_can_request_to_reset_password()
    {
        // Test code
        //arrange


        //act


        //assert


    }


    /** @*/
    function can_see_update_log()
    {
        // Test code
        //arrange


        //act


        //assert


    }
}
