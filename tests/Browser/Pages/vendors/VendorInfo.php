<?php

namespace Tests\Browser\Pages\vendors;

use App\Models\Vendor;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class VendorInfo extends BasePage
{
    private $vendor;

    /**
     * VendorInfo constructor.
     * @param $vendor
     */
    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }


    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/vendors/'.$this->vendor->id;
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

    public function assertSeeVendorDetail(Browser $browser, Vendor $vendor)
    {
        $browser
            ->assertSee($vendor->title)
//            ->assertSee($vendor->sn)
            ->assertSee('聯絡方式')
            //聯絡廠商 link
            ->with('#emailVendor', function ($link) {
                $link->assertSee('聯絡廠商');
            })
            ->assertSee('廠商簡介')
            ->assertSee('營業據點')
            ->assertSee('服務項目')
            ->assertSee('服務區域');

        //other vendor specific details

        //on sell equipments
    }
}
