<?php

namespace Tests\Browser\UserAccount;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\HomePage;
use Tests\Browser\Pages\UserAccount\SignIn;
use Tests\Browser\Pages\UserAccount\Register;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group browser
 * @group UserAccount
 * @group UserAccountBasic
 *
 * */
class UserAccountBasicBrowserTest extends DuskTestCase
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
                'email' => 'jack@example.com',
                'name' => 'Jack Welsh',
                'password' => bcrypt('secret')
            ]);


            //email sign in
            $this->can_signIn_with_email($browser, $user);
            $this->cannot_signIn_if_not_enough_info_provided($browser, $user);

            //register
            $this->can_register_an_account_with_email($browser);
            $this->cannot_register_if_not_enough_info_provided($browser);

            //signIn user page control
            $this->page_notAllowed_for_signedIn_user($browser, $user);
        });
    }


    private function page_notAllowed_for_signedIn_user(Browser $browser, $user)
    {
        $browser->loginAs($user);

        //visit signIn page
        $browser->visit(new HomePage)
            ->visit('/login')
            ->on(new HomePage);

        //visit Register page
        $browser->visit(new HomePage)
            ->visit('register')
            ->on(new HomePage);

        $this->userLogout($browser);
    }


    private function cannot_signIn_if_not_enough_info_provided(Browser $browser, $user)
    {
        //wrong email
        $browser->visit(new SignIn)
            ->emailSignIn(
                $user->name,
                'crazy@example.com',
                'secret'
            )
            ->assertSignInFailed()
            ->on(new SignIn);

        //wrong password
        $browser->visit(new SignIn)
            ->emailSignIn(
                $user->name,
                $user->email,
                'wrongPass'
            )
            ->assertSignInFailed()
            ->on(new SignIn);


        //no email
        $browser->visit(new SignIn)
            ->emailSignIn(
                $user->name,
                '',
                'secret'
            )
            ->on(new SignIn);

        //no password
        $browser->visit(new SignIn)
            ->emailSignIn(
                $user->name,
                $user->email,
                ''
            )
            ->on(new SignIn);
    }


    private function cannot_register_if_not_enough_info_provided(Browser $browser)
    {
        //email missing
        $browser->visit(new Register)
            ->emailRegistration(
                '',
                'Jack Welsh',
                'secret',
                'secret',
                1
            )
            ->on(new Register);

        //name missing
        $browser->visit(new Register)
            ->emailRegistration(
                'jack@example.com',
                '',
                'secret',
                'secret',
                1
            )
            ->on(new Register);

        //password missing
        $browser->visit(new Register)
            ->emailRegistration(
                'jack@example.com',
                'Jack Welsh',
                '',
                'secret',
                1
            )
            ->on(new Register);

        //password confirmation missing
        $browser->visit(new Register)
            ->emailRegistration(
                'jack@example.com',
                'Jack Welsh',
                'secret',
                '',
                1
            )
            ->on(new Register);

        //agree policy missing
        $browser->visit(new Register)
            ->emailRegistration(
                'jack@example.com',
                'Jack Welsh',
                'secret',
                'secret',
                0
            )
            ->on(new Register);
    }


    private function assertSeeLogout(Browser $browser, $name)
    {
        $browser->assertPathIs('/')
            ->assertDontSee($name)
            ->assertSee('登入')
            ->assertSee('註冊');

        return $this;
    }


    /**
     *
     * @param $browser
     */
    private function can_register_an_account_with_email(Browser $browser)
    {
        $browser->visit(new Register)
            ->emailRegistration(
                'john@example.com',
                'John Doe',
                'secret',
                'secret',
                1
            )
            ->assertRegistrationSuccessful('john@example.com');

        $this->userLogout($browser)
            ->assertSeeLogout($browser, 'John Doe');
    }


    private function can_signIn_with_email(Browser $browser, $user)
    {
        //sign in
        $browser->visit(new SignIn)
            ->emailSignIn(
                $user->name,
                $user->email,
                'secret'
            )
            ->assertSignInSuccessful($user->name);

        $this->userLogout($browser)
            ->assertSeeLogout($browser, 'Jack Welsh');
    }


    /**
     * @group integration
     */
    function can_register_with_fb_account()
    {
        // Test code
        //arrange


        //act


        //assert


    }
}
