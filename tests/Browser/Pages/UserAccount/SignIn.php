<?php

namespace Tests\Browser\Pages\UserAccount;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class SignIn extends BasePage
{
    private $user;

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
            ->assertSee('電子信箱')
            ->assertSee('密碼')
            ->assertSee('使用電子信箱登入');
    }


    public function emailSignIn(
        Browser $browser,
        $name = '', $email = '', $password = '')
    {
        $this->user['name'] = $name;
        $this->user['email'] = $email;
        $this->user['password'] = $password;

        $browser->type('email', $this->user['email'])
            ->type('password', $this->user['password'])
            ->click('#doLogin');
    }


    public function assertSignInSuccessful(Browser $browser, $name)
    {
        $browser
            ->assertPathIs('/')
            ->assertSee($name);
    }


    public function assertSignInFailed(Browser $browser)
    {
        $browser
            ->assertPathIs('/login')
            ->assertDontSee($this->user['name']);
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
