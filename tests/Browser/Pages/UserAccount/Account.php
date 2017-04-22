<?php

namespace Tests\Browser\Pages\UserAccount;

use App\User;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Account extends BasePage
{

    private $user;

    /**
     * Account constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/account';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url())
            ->assertSee($this->user->name)
            ->assertSee('個人帳號');
    }

    public function assertSeeUnverifiedWarning(Browser $browser, $actionName = null)
    {
        $actionName = $actionName ? $actionName : '使用指定功能';

        $browser->assertSee("您需要先認證您的電子信箱,才能{$actionName}!");
    }
}
