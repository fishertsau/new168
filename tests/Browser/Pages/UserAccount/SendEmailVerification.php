<?php

namespace Tests\Browser\Pages\UserAccount;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use Tests\Browser\Pages\HomePage;

class SendEmailVerification extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/email/verification';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
            ->assertSee('寄送郵件認證信')
            ->assertSee('電子信箱');
    }


    public function sendRequest(Browser $browser, $email = '')
    {
        $browser->type('email', $email)
            ->click('#submitForm');
    }


    public function assertEmailConfirmationResent(Browser $browser)
    {
        $browser->waitFor('.modal')
            ->assertSee('寄送成功')
            ->assertSee('請收取您的電子郵件,並依照步驟認證您的電子信箱')
            ->press('Close');
    }


    public function assertWrongEmail(Browser $browser)
    {
        $browser
            ->waitFor('.modal')
            ->assertSee('請輸入正確的電子信箱!')
            ->assertSee('電子信箱不正確')
            ->press('Close');
    }

    public function assertAccountVerifiedNotNecessary(Browser $browser)
    {
        $browser
            ->waitFor('.modal')
            ->assertSee('您的信箱已認證,不須再認證!')
            ->assertSee('信箱已認證')
            ->press('Close');
    }


    public function assertAccountVerified(Browser $browser)
    {
        $browser->on(new HomePage());

        $browser->waitFor('.modal')
            ->assertSee('認證成功')
            ->assertSee('您的電子信箱已認證完成!')
            ->press('Close');
    }

    public function assertAccountVerificationFailed(Browser $browser)
    {
        $browser->on(new HomePage());

        $browser->waitFor('.modal')
            ->assertSee('認證失敗')
            ->assertSee('請重新認證!如有任何問題,請與我們聯絡')
            ->press('Close');
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
