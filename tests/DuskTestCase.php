<?php

namespace Tests;

use Laravel\Dusk\Browser;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()
        );
    }

    protected function userLogout(Browser $browser)
    {
        $nameElement = $browser->element('#username');

        if (!(($nameElement === '') || ($nameElement === null))) {
            $browser->click('#username')
                ->waitFor('.logoutForm')
                ->assertSee('登出')
                ->click('#doLogout');
        }

        return $this;
    }
}
