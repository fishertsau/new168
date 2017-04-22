<?php

use App\Models\Occasion;
use App\Models\Device\Device;
use App\Repository\DeviceRepository;
use Acme\Tool\Filterable\DeviceFilter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @group device
 * @group tdd
 */
class DeviceRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private $deviceRepo;

    protected function setUp()
    {
        parent::setUp();
        $this->deviceRepo = App::make(DeviceRepository::class);
    }

    /** @test */
    function can_sync_occasions()
    {
        factory(Occasion::class, 10)->create();
        $device = factory(Device::class)->create();

        $this->deviceRepo->syncOccasions($device, [1, 2, 3, 4]);
        $this->assertEquals([1, 2, 3, 4], mapAttribute($device->fresh()->occasions, 'id'));

        $this->deviceRepo->syncOccasions($device, [2, 3, 5, 6]);
        $this->assertEquals([2, 3, 5, 6], mapAttribute($device->fresh()->occasions, 'id'));
    }


//    /** @test */
//    function a_device_could_be_deleted_by_its_owner_or_authorized_persons()
//    {
    /*
     * how to allow only authorized person?
     * */

    //arrange
    //(1)add in occasions
//        $occasionIdList = [1, 2];
//        $this->device->syncOccasions($occasionIdList);
//
//        //(2)raise discussion
//        $content = "I want to raise a discussion.  Here is the content";
//        $this->device->raiseDiscussion($content);
//        $this->device->raiseDiscussion($content);
//
//        //(3) like devices
//        $this->device->like();
//
//        //(4) device address
//        $address = [
//            'city' => 1,
//            'zip' => 103,
//            'street' => "Road"
//        ];
//        $this->device->createOrUpdateAddress($address);
//
//        //(5)save photo
//        $uploadedFile = fakeUploadedFile();
//        $photo = $this->photoRepository->storeOrUpdate(
//            $uploadedFile,
//            $this->device,
//            'coverphoto');
//        $filepath = $photo->filepath;
//
//        //when
//        $this->device->delete();
//
//        //then
//        //occasions are cleared
//        $this->notSeeInDatabase('device_occasion', [
//            'device_id' => $this->device->id,
//            'occasion_id' => 1
//        ], null, "The item 1 should not be seen");
//
//        $this->notSeeInDatabase('device_occasion', [
//            'device_id' => $this->device->id,
//            'occasion_id' => 2
//        ], null, "The occasion for item 2 should not been seen.");
//
//        //discussion is cleared
//        $this->notSeeInDatabase('discussions',
//            [
//                'user_id' => $this->user->id,
//                'discussionable_id' => $this->device->id,
//                'discussionable_type' => get_class($this->device),
//                'content' => $content
//            ]
//            , null, "The discussion should not been seen.");
//
//        //likes is cleared
//        $this->notSeeInDatabase('likes',
//            ['user_id' => $this->user->id,
//                'likeable_id' => $this->device->id,
//                'likeable_type' => get_class($this->device)]);
//
//        //address is cleared
//        $this->notSeeInDatabase('addresses', $address, null, "The address should not be seen.");
//
//        //photo is cleared
//        $this->assertEmpty($photo->fresh());
//        $this->assertFileNotExists(app_storagePath($filepath),
//            "The photo file should not seen found");
//
//        //The device itself is cleared
//        $this->assertEmpty($this->device->fresh());
//
//        makeCopy('app\test2.jpg', 'app\test.jpg');
//    }


    /** @test */
    function could_know_if_query_is_not_from_admin()
    {
        $deviceFilter = $this->spy(DeviceFilter::class);
        $deviceRepo = App::make(DeviceRepository::class);

        $deviceRepo->getList(['keyword' => 'abc']);
        $deviceFilter->shouldHaveReceived('getList')->once()
            ->with(['keyword' => 'abc'], false);
    }

    /** @test */
    function could_know_if_query_if_from_admin()
    {
        $deviceFilter = $this->spy(DeviceFilter::class);
        $deviceRepo = App::make(DeviceRepository::class);

        $deviceRepo->getList(['keyword' => 'abc'], 'admin');
        $deviceFilter->shouldHaveReceived('getList')->once()
            ->with(['keyword' => 'abc'], true);
    }


    /** @test */
    function could_destroy_a_device()
    {
        $device = factory(Device::class)->create();

        $this->deviceRepo->destroy($device);

        $this->assertNull($device->fresh());
    }

    /** @test */
    function could_find_by_serial_number()
    {
        $device = factory(Device::class)->create();

        $foundDevice = $this->deviceRepo->findBySN($device->sn);

        $this->assertEquals($device->id, $foundDevice->id);
    }

    /** @test */
    function can_see_modelNotFoundException_if_not_find_by_SN()
    {
        factory(Device::class)->create();

        try {
            $this->deviceRepo->findBySN('strangeSN');
        } catch (ModelNotFoundException $e) {
            return;
        }
        $this->fail();
    }

}
