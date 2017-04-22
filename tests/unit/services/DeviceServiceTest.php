<?php

use App\User;
use App\Models\Occasion;
use App\Models\Device\Device;
use Acme\Tool\Filterable\DeviceFilter;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 * @group device
 * @group service
 * */
class DeviceServiceTest extends TestCase
{
    use DatabaseMigrations;

//    /** @test */
//    function a_device_could_be_published_and_unpublished_by_its_owner()
//    {
//        $owner = factory('App\User')->create();
//        $guest = factory('App\User')->create();
//
//        $device =
//            $owner->devices()->create($this->deviceSetting);
//
//        $expectedNotActive = [
//            'id' => $device->id,
//            'user_id' => $owner->id,
//            'active' => false,
//        ];
//
//        $expectedActive = [
//            'id' => $device->id,
//            'user_id' => $owner->id,
//            'active' => true
//        ];
//
//        $this->seeInDatabase('devices', $expectedNotActive);
//
//        //The non-owner to the device is logged in
//        Auth::loginUsingId($guest->id);
//        $this->expectException(get_class(new Exception), 'Expect to see Exception when publish');
//        $device->publish();
//
//        $this->expectException(get_class(new Exception), 'Expect to see Expectation when unpublish');
//        $device->unPublish();
//
//
//        //when the owner of the device is logged in
//        Auth::loginUsingId($owner->id);
//
//        $device->publish();
//        $this->seeInDatabase('devices', $expectedActive);
//
//        $device->unPublish();
//        $this->seeInDatabase('devices', $expectedNotActive);
//    }


//    /** @test */
//    function a_device_could_toggle_its_publish_status()
//    {
//        $expectedNotActive = [
//            'id' => $this->device->id,
//            'user_id' => $this->user->id,
//            'active' => false,
//        ];
//
//        $expectedActive = [
//            'id' => $this->device->id,
//            'user_id' => $this->user->id,
//            'active' => true
//        ];
//
//        $this->seeInDatabase('devices', $expectedNotActive);
//        $this->device->togglePublish();
//        $this->seeInDatabase('devices', $expectedActive);
//        $this->device->togglePublish();
//        $this->seeInDatabase('devices', $expectedNotActive);
//    }

//    /** @test */
//    function the_due_is_one_month_from_published_date()
//    {
//        $device =
//            $this->user->devices()->create($this->deviceSetting);
//
//        $device->publish();
//
//        $deviceDue = $device->due_until->toFormattedDateString();
//        $futureDue = (\Carbon\Carbon::now()->addMonth($device->getLifeSpan())->toFormattedDateString());
//
//        $this->assertEquals($deviceDue, $futureDue, "The device due day should be $device->lifespan month(s) from now.");
//    }

}
