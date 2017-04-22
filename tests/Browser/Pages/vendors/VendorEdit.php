<?php

namespace Tests\Browser\Pages\vendors;

use App\Models\Vendor;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class VendorEdit extends BasePage
{
    private $vendor;

    /**
     * VendorEdit constructor.
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
        return '/vendors/' . $this->vendor->id . "/edit";
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


    public function doVendorUpdate(Browser $browser, $input)
    {
        $browser
//            ->select('cat', $input['cat'])
            ->type('title', $input['title'])
            ->press('儲存並看結果');
    }


    public function assertSeeVendorEdit(Browser $browser, Vendor $vendor)
    {
        $browser
            ->assertSee('編輯廠商資料')

            //control
            ->assertSee('允許公開查詢')

            //Basic info
            ->assertSee('廠商型態')
            ->assertSee('類別')
            ->assertSee('廠商名稱')

            //contact info
            ->assertSee('聯絡電話')
            ->assertSee('傳真號碼')
            ->assertSee('粉絲頁')
            ->assertSee('電子信箱')
            ->assertSee('官網')
            ->assertSee('聯絡人')

            //description
            ->assertSee('廠商簡介')
            ->assertSee('營業據點')
            ->assertSee('服務項目')
            ->assertSee('提供產品')
            ->assertSee('服務區域')

            //maintenance capability
            ->assertSee('有維修服務')
            ->assertSee('主要維修設備')

            //photo
            ->assertSee('主要圖片')
            ->assertSee('介紹圖片');
    }
}
