<?php

namespace Tests\Browser\Pages\vendors;

use App\Models\Vendor;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class VendorCreation extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/vendors/create';
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


    public function assertSeeVendorCreation(Browser $browser)
    {
        $browser
            ->assertSee('建立廠商')
            ->assertSee('廠商基本資料')
            ->assertSee('廠商型態')
            ->assertSee('類別')
            ->assertSee('廠商名稱');
    }


    public function doVendorCreate(Browser $browser, $input = [])
    {
        $input = collect($input);

        $title = $input->has('title') ? $input['title'] : '';

        $browser
//            ->select('cat', $input['cat'])
            ->type('title', $title)
            ->press('開始輸入詳細資料');
    }


    public function assertVendorCreated(Browser $browser, Vendor $vendor)
    {
        $browser->on(new VendorEdit($vendor));
    }
}
