<?php

namespace Tests\Browser\Pages\vendors;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class VendorQuery extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/vendors';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    public function assertSeeVendorQuery(Browser $browser)
    {
        $browser->assertSee('尋找廠商');
    }

    public function doKeywordQuery(Browser $browser, $keyword)
    {
    }
}
