<?php

use Carbon\Carbon;
use App\Models\Occasion;
use App\Models\Device\Device;
use Acme\Tool\Filterable\DeviceFilter;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group tdd
 * @group device
 * @group filter
 * */
class DeviceFilterTest extends TestCase
{
    use DatabaseMigrations;

    private $deviceFilter;

    /** @before */
    function setUpItem()
    {
        $this->deviceFilter = App::make(DeviceFilter::class);
    }


    /** @test
     * @group filter
     */
    function devices_could_be_queried()
    {
        //keyword
        $newDeviceQty = random_int(1, 10);
        factory(Device::class, $newDeviceQty)->states('published')
            ->create(['title' => '超級無敵冰箱']);

        $queryResult = $this->deviceFilter->getList(['keyword' => '冰箱']);

        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));

        //device category id
        $newDeviceQty = random_int(1, 10);
        factory(Device::class, $newDeviceQty)->states('published')->create(['cat_id' => 10]);

        $queryResult = $this->deviceFilter->getList(['cat_id' => 10]);

        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));


        //price range
        $newDeviceQty = random_int(1, 10);
        factory(Device::class, $newDeviceQty)->states('published')->create(['price' => random_int(3000, 10000)]);

        $queryResult = $this->deviceFilter->getList(['price_lower' => 3000, 'price_upper' => 10000]);

        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));


        //gas type
        $newDeviceQty = random_int(1, 10);
        factory(Device::class, $newDeviceQty)->states('published')->create(['gas_type' => '天然氣']);

        $queryResult = $this->deviceFilter->getList(['gas_type' => '天然氣']);

        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));


        //voltage
        $newDeviceQty = random_int(1, 10);
        factory(Device::class, $newDeviceQty)->states('published')->create(['voltage' => '110V']);

        $queryResult = $this->deviceFilter->getList(['voltage' => '110V']);

        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));

        //occasion
        factory(Occasion::class, 10)->create();
        $newDeviceQty = random_int(1, 10);
        collect(factory(Device::class, $newDeviceQty)->states('published')->create())
            ->each(function ($device) {
                $device->occasions()->sync([1, 2]);
            });

        //act+assert
        $queryResult = $this->deviceFilter->getList(
            ['occasion' => 2]);
        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));

        $queryResult = $this->deviceFilter->getList(
            ['occasion' => 1]);
        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));

        //keyword + gas type
        $newDeviceQty = random_int(1, 10);
        factory(Device::class, $newDeviceQty)->states('published')->create([
            'title' => '無敵咖啡機',
            'gas_type' => '天然氣'
        ]);

        $queryResult = $this->deviceFilter->getList(['keyword' => '咖啡', 'gas_type' => '天然氣']);
        $this->assertCount($newDeviceQty, $this->extractDevices($queryResult));
    }


    /** @test */
    function could_be_queried_by_city_and_zip()
    {
        factory(Device::class, 3)->states('published')->create(['city' => 1, 'zip' => 100]);
        factory(Device::class, 4)->states('published')->create(['city' => 1, 'zip' => 200]);

        //act + assert
        $queryResult = $this->deviceFilter->getList(
            ['city' => 1]);

        $this->assertCount(7, $this->extractDevices($queryResult));


        //act + assert
        $queryResult = $this->deviceFilter->getList(
            ['city' => 1, 'zips' => [100]]);
        $this->assertCount(3, $this->extractDevices($queryResult));

        //act + assert
        $queryResult = $this->deviceFilter->getList(
            ['city' => 1, 'zips' => [200]]);
        $this->assertCount(4, $this->extractDevices($queryResult));

        //act + assert
        $queryResult = $this->deviceFilter->getList(
            ['city' => 1, 'zips' => [100, 200]]);
        $this->assertCount(7, $this->extractDevices($queryResult));
    }


    private function extractDevices($paginatedResult)
    {
        $devices = collect($paginatedResult);
        return collect($devices['data']);
    }


    /** @test */
    function could_be_ordered_by()
    {
        $devices = factory(Device::class, 30)
            ->states('published')
            ->create([
                'price' => function () {
                    return random_int(100, 50000);
                },
                'created_at' => function () {
                    $date = Carbon::create(2015, 5, 28, 0, 0, 0);
                    return $date->addWeeks(rand(1, 52));
                },
                'reads' => function () {
                    return random_int(1, 500);
                }
            ]);

        //by price
        $oderByField = 'price';
        $queryResult = $this->deviceFilter->getList(
            ['order_by' => $oderByField, 'order_sequence' => 'asc']);

        $this->assertEquals(
            $this->getSortedAttribute($devices, $oderByField, $oderByField, 10),
            $this->extractDevices($queryResult)->pluck($oderByField)
        );

        $queryResult = $this->deviceFilter->getList(
            ['order_by' => $oderByField, 'order_sequence' => 'desc']);
        $this->assertEquals(
            $this->getSortedAttribute($devices, $oderByField, $oderByField, 10, 'desc'),
            $this->extractDevices($queryResult)->pluck($oderByField)
        );

        //by created date
        $oderByField = 'created_at';
        $queryResult = $this->deviceFilter->getList(
            ['order_by' => $oderByField, 'order_sequence' => 'asc']);

        $this->assertEquals(
            $this->getSortedAttribute($devices, $oderByField, $oderByField, 10),
            $this->extractDevices($queryResult)->pluck($oderByField)
        );

        $queryResult = $this->deviceFilter->getList(
            ['order_by' => 'created_at', 'order_sequence' => 'desc']);
        $this->assertEquals(
            $this->getSortedAttribute($devices, 'created_at', 'created_at', 10, 'desc'),
            $this->extractDevices($queryResult)->pluck('created_at')
        );

        //by reads
        $oderByField = 'reads';
        $queryResult = $this->deviceFilter->getList(
            ['order_by' => $oderByField, 'order_sequence' => 'asc']);

        $this->assertEquals(
            $this->getSortedAttribute($devices, $oderByField, $oderByField, 10),
            $this->extractDevices($queryResult)->pluck($oderByField)
        );

        $queryResult = $this->deviceFilter->getList(
            ['order_by' => $oderByField, 'order_sequence' => 'desc']);
        $this->assertEquals(
            $this->getSortedAttribute($devices, $oderByField, $oderByField, 10, 'desc'),
            $this->extractDevices($queryResult)->pluck($oderByField)
        );
    }


    /** @test */
    function published_and_unpublished_devices_could_be_queried_by_admin()
    {
        factory(Device::class, 3)->states('published')->create(['title' => '超級無敵冰箱']);
        factory(Device::class, 5)->states('unpublished')->create(['title' => '超級無敵冰箱']);

        //act + assert
        $queryResult = $this->deviceFilter->getList(
            ['keyword' => '冰箱'], $admin = false);

        $this->assertCount(3, $this->extractDevices($queryResult));


        //act + assert
        $queryResult = $this->deviceFilter->getList(
            ['keyword' => '冰箱'], $admin = true);

        $this->assertCount(8, $this->extractDevices($queryResult));
    }


    /**
     * @param $collection
     * @param $orderByField
     * @param $pluckCol
     * @param int $take
     * @param string $sequence
     * @return mixed
     */
    private function getSortedAttribute($collection, $orderByField, $pluckCol,
                                        $take = 10, $sequence = '')
    {
        if ($sequence == 'desc') {
            return $collection->sortByDesc($orderByField)->pluck($pluckCol)->take($take);
        }

        return $collection->sortBy($orderByField)->pluck($pluckCol)->take($take);
    }
}
