<?php

use App\User;
use App\Models\Occasion;
use App\Models\Device\Device;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class ModelOwnerTest
 * @group device
 * @group tdd
 */
class DeviceTest extends TestCase
{
    use DatabaseMigrations;

    /** @test
     */
    function device_could_be_saved_by_user()
    {
        $user = factory(User::class)->create();

        $device = $user->devices()->create(['cat_id' => 1, 'title' => 't1']);

        $this->assertEquals($user->id, $device->user->id);
    }


    /** @test
     */
    function each_device_has_unique_sn()
    {
        factory(Device::class, 10)->create(['user_id' => 1]);

        $sns = DB::table('devices')->pluck('sn');

        $this->assertCount(10, $sns, "There should be 10 sns.");
    }


    /** @test
     */
    function can_get_occasions()
    {
        factory(Occasion::class, 10)->create();
        $device = factory(Device::class)->create(['user_id' => 1]);

        $device->occasions()->sync([1, 2, 3]);

        $this->assertCount(3, $device->fresh()->occasions);
        $this->assertEquals([1, 2, 3], mapAttribute($device->fresh()->occasions, 'id'));
    }


    /** @test
     */
    function can_get_user()
    {
        $user = factory(User::class)->states('verified')->create();
        $device = factory(Device::class)->make(['user_id' => $user->id]);

        $this->assertEquals($user->id, $device->user->id);
    }


    /** @test */
    function can_get_dimension()
    {
        $device = factory(Device::class)->create(['user_id' => 1]);

        $device = $device->fresh();

        $this->assertEquals("", $device->dimension['width']);
        $this->assertEquals("", $device->dimension['height']);
        $this->assertEquals("", $device->dimension['depth']);
    }


    /** @test */
    function can_get_city()
    {
        // Test code
        //arrange


        //act


        //assert


    }

    /** @test */
    function can_get_zip()
    {
        // Test code
        //arrange


        //act


        //assert


    }


    /** @test */
    function can_get_address()
    {
        // Test code
        //arrange


        //act


        //assert


    }

    /** @test */
    function can_get_reads()
    {
        $device = factory(Device::class)->make(['reads' => 3]);

        $this->assertEquals(3, $device->reads);
    }

    /** @test */
    function can_get_publish_status()
    {
        $device = factory(Device::class)->states('published')->make();
        $this->assertTrue($device->published);

        $device = factory(Device::class)->states('unpublished')->make();
        $this->assertFalse($device->published);
    }


    /** @test */
    function can_get_specs()
    {
        $specs = [
            'specs' => [
                ['title' => '重量', 'description' => '100kg'],
                ['title' => '瓦數', 'description' => '100W'],
                ['title' => '製冰機', 'description' => 'des3']
            ]];
        $device = factory(Device::class)->create(
            $specs);

        $this->assertEquals($specs['specs'], $device->specs);
    }


    /** @test */
    function should_see_device_info_when_queried()
    {
        $d = factory(Device::class)->make()->toArray();

        //Should see
        $this->assertArrayHasKey('coverphoto', $d);
        $this->assertArrayHasKey('cat', $d);

        //Should not see
        $this->assertArrayNotHasKey('user_id', $d);
    }

    /** @test */
    function is_discussionable()
    {
        $d = factory(Device::class)->make();
        $this->assertTrue($d instanceof Acme\Tool\Discussionable\Discussionable);
    }
}
