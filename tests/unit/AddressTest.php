<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * Class AddressTest
 */
class AddressTest extends TestCase
{
    use DatabaseMigrations;

    protected $deviceSetting = ['title' => 'title', 'cat_id' => 1];
    protected $addressInput1 = [
        'city' => 1,
        'zip' => 103,
        'street' => "Road"
    ];

    protected $addressInput2 = [
        'city' => 2,
        'zip' => 227,
        'street' => "Road123"
    ];

    protected $wrongAddressInput = [
        'city' => 3,
        'zip' => 103,
        'street' => "Road123AAA"
    ];


    /** @before */
    function setUpItems()
    {
        $this->signInUser();
    }

    /** @test */
    function an_address_could_be_added()
    {
        //given
        $device = $this->user->devices()->create($this->deviceSetting);

        //when
        $device->createOrUpdateAddress($this->addressInput1);

        //then
        $this->seeInDatabase('addresses', $this->addressInput1);
    }

    /** @test */
    function an_address_can_be_updated()
    {
        //given
        $device = $this->user->devices()->create($this->deviceSetting);
        $device->address()->create($this->addressInput1);

        //when
        $device->createOrUpdateAddress($this->addressInput2);

        //then
        $this->notSeeInDatabase('addresses', $this->addressInput1);
        $this->seeInDatabase('addresses', $this->addressInput2);
    }

    /** @test */
    function an_address_could_be_deleted()
    {
        //given
        $device = $this->user->devices()->create($this->deviceSetting);
        $device->address()->create($this->addressInput1);

        //when
        $device->deleteAddress();

        //then
        $this->notSeeInDatabase('addresses', $this->addressInput1);
    }


    /** @test */
    function address_is_only_allowed_to_be_saved_when_areas_located_in_designated_city()
    {
        //given
        $device = $this->user->devices()->create($this->deviceSetting);

        //when
        $this->expectException(Exception::class);
        $device->createOrUpdateAddress($this->wrongAddressInput);

        //then
        $this->notSeeInDatabase('addresses', $this->wrongAddressInput);
    }
}
