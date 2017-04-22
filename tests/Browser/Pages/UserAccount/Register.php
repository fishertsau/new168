<?php

namespace Tests\Browser\Pages\UserAccount;

use App;
use App\Repository\UserRepository;
use App\User;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Register extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/register';
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
            ->assertSee('使用者名稱')
            ->assertSee('密碼')
            ->assertSee('確認密碼')
            ->assertSee('使用信箱');
    }


    public function emailRegistration(
        Browser $browser,
        $email = '', $name = '', $password = '',
        $password_confirmation = '', $agreed = 0
    )
    {
        $browser->type('email', $email)
            ->type('name', $name)
            ->type('password', $password)
            ->type('password_confirmation', $password_confirmation);

        if ($agreed === 1) {
            $browser->check('agreed');
        }

        //form submit
        $browser->click('#doRegister');
    }


    public function assertRegistrationSuccessful(Browser $browser,$email)
    {
        $browser
            ->waitFor('.modal')
            ->assertSee('註冊成功')
            ->assertSee('請收取我們剛寄給您的電子郵件,並依照步驟認證電子信箱')
            ->press('Close');

        //assert user on account page
        $user = User::where('email',$email)->first();
        $browser->on(new Account($user));
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
