<?php

namespace Tests\Browser\Pages\UserAccount;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class ForgetPassword extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/password/reset';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
            ->assertSee('忘記密碼了')
            ->assertSee('重設密碼')
            ->assertSee('Facebook')
            ->assertSee('快速登入');
    }


    public function sendForgetPasswordRequest(Browser $browser, $email = '')
    {
        $browser
            ->type('email', $email)
            ->press('重設密碼');
    }


    public function assertRequestSucceeded(Browser $browser)
    {
        $browser
            ->assertSee('我們剛寄一個郵件給您,請依照裡面步驟重設密碼');
    }


    public function assertRequestFailed(Browser $browser)
    {
        $browser
            ->assertSee('請輸入當時註冊的電子郵件信箱');
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
