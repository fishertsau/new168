<?php


use App\Http\Controllers\PhotoController;
use Symfony\Component\HttpFoundation\FileBag;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class PhotoControllerTest
 */
class PhotoControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected $device;
    protected $photoController;
    protected $deviceSetting = ['title' => 'title', 'cat_id' => 1];
    /** @before
     * @param PhotoController $photoController
     */
    function setUp()
    {
        parent::setUp();
        $this->photoController = new PhotoController(new \App\Repository\PhotoRepository());
        $this->signInUser();
        $this->device = $this->user->devices()->create($this->deviceSetting);
    }

    /** @test */
    function a_photo_from_a_request_could_be_saved()
    {
        //given
        $request = $this->mockRequest();

        //when
        $photo = $this->photoController
            ->store('device', $this->device->id, $request);

        //then
        $this->assertFileExists(public_path().$photo->filepath);

        $this->restorePhotoFileToOriginalPlace($photo->filepath);
    }


    /** @test */
    function a_photo_could_be_saved_with_specified_field()
    {
        //given
        $request = $this->mockRequest();
        $fieldname = 'coverPhoto';

        //when
        $photo = $this->photoController
            ->store('device', $this->device->id, $request, $fieldname);

        //then
        $expected = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $photo->filepath,
            'field' => $fieldname
        ];

        $this->seeInDatabase('photos', $expected);
        $this->assertFileExists(public_path().$photo->filepath);

        $this->restorePhotoFileToOriginalPlace($photo->filepath);
    }

    /** @test */
    function a_photo_could_be_updated_for_specified_field()
    {
        //given
        $request = $this->mockRequest();
        $fieldName = 'coverPhoto';

        $originalPhoto = $this->photoController
            ->store('device', $this->device->id, $request, $fieldName);


        $oldResult = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $originalPhoto->filepath,
            'field' => $fieldName
        ];

        //when
        $newRequest = $this->anotherMockRequest();
        $newPhoto = $this->photoController
            ->store('device', $this->device->id, $newRequest, $fieldName);

        //then
        $newResult = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $newPhoto->filepath,
            'field' => $fieldName
        ];

        $this->assertFileNotExists(public_path().$originalPhoto->filepath,
            "The old photo file should not seen found");
        $this->notSeeInDatabase('photos', $oldResult);

        $this->seeInDatabase('photos', $newResult);
        $this->assertFileExists(public_path().$newPhoto->filepath);

        $this->restorePhotoFileToOriginalPlace($newPhoto->filepath);
        File::copy(storage_path('app\test.jpg'), storage_path('app\test2.jpg'));
    }


    /** @test */
    function a_photo_could_be_deleted()
    {
        //given
        $request = $this->mockRequest();
        $photo = $this->photoController
            ->store('device', $this->device->id, $request);
        $filepath = $photo->filepath;

        //when
        $this->photoController->delete($filepath);

        //then
        $this->assertEmpty($photo->fresh());
        $this->assertFileNotExists(public_path().$filepath,
            "The original photo file should not seen found");

        File::copy(storage_path('app\test2.jpg'), storage_path('app\test.jpg'));
    }


    protected function restorePhotoFileToOriginalPlace($filepath)
    {
        File::move(public_path().$filepath, storage_path('app\test.jpg'));
    }


    protected function mockRequest()
    {
        $request = new \Illuminate\Http\Request(['fieldName' => 'coverPhoto']);
        $request->files = new FileBag([
            'photofile' => fakeUploadedFile()
        ]);
        return $request;
    }

    protected function anotherMockRequest()
    {
        $request = new \Illuminate\Http\Request(['fieldName' => 'coverPhoto']);
        $request->files = new FileBag([
            'photofile' => fake2ndUploadedFile()
        ]);
        return $request;
    }


    protected function mockRequestWithoutFile()
    {
        $request = new \Illuminate\Http\Request(['fieldName' => 'coverPhoto']);
        $request->files = [
            'photofile' => ''
        ];
        return $request;
    }
}
