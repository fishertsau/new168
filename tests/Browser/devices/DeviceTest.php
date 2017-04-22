<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeviceTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function ($browser) {
            $browser->visit('/devices')
                ->type('keyword', '冰箱')
                ->press('搜尋')
                ->pause(1000)
                ->assertSee('冰箱');
        });
    }
}
