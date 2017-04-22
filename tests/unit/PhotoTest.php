<?php

use App\Models\DummyModel;
use App\Models\Device\Device;
use App\Repository\PhotoRepository;
use App\Exceptions\PhotoableNotAllowedException;


use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class PhotoTest
 */
class PhotoTest extends TestCase
{
    use DatabaseTransactions;

    protected $photoRepository;
    protected $deviceSetting = ['title' => 'title', 'cat_id' => 1];

    function setUp()
    {
        parent::setUp();
        $this->photoRepository = new PhotoRepository();
        $this->signInUser();
        $device = new Device($this->deviceSetting);
        $this->device = $this->user->devices()->save($device);
    }


    /** @test */
    function a_photo_could_be_stored_by_a_model()
    {
        //given
        $uploadedFile = fakeUploadedFile();

        //when
        $photo = $this->photoRepository->storeOrUpdate(
            $uploadedFile,
            $this->device);

        //then
        $expectedResult = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $photo->filepath,
        ];

        $this->seeInDatabase('photos', $expectedResult);
        $this->assertFileExists(app_storagePath($photo->filepath));
        $this->assertContains($this->device->getPhotoDir(), $photo->filepath);

        $this->restorePhotoFileToOriginalPlace($photo->filepath);
    }


    /** @test */
    function a_photo_could_be_saved_by_a_model_with_specified_field()
    {
        //given
        $uploadedFile = fakeUploadedFile();
        $fieldName = 'coverPhoto';

        //when
        $photo = $this->photoRepository->storeOrUpdate(
            $uploadedFile,
            $this->device,
            $fieldName);

        //then
        $expectedResult = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $photo->filepath,
            'field' => $fieldName
        ];

        // the photo entry is seen in the database
        $this->seeInDatabase('photos', $expectedResult);
        $this->assertFileExists(app_storagePath($photo->filepath));

        $this->restorePhotoFileToOriginalPlace($photo->filepath);
    }

    /** @test */
    function a_photo_could_be_updated_by_a_model_with_specified_field()
    {
        //given
        $uploadedFile = fakeUploadedFile();
        $fieldName = 'coverPhoto';

        $originalPhoto = $this->photoRepository->storeOrUpdate(
            $uploadedFile,
            $this->device,
            $fieldName);

        $oldResult = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $originalPhoto->filepath,
            'field' => $fieldName
        ];

        //when
        $newUploadedFile = fake2ndUploadedFile();
        $newPhoto = $this->photoRepository->storeOrUpdate(
            $newUploadedFile,
            $this->device,
            $fieldName);

        //then
        $newResult = [
            'photoable_id' => $this->device->id,
            'photoable_type' => get_class($this->device),
            'filepath' => $newPhoto->filepath,
            'field' => $fieldName
        ];

        $this->assertFileNotExists(app_storagePath($originalPhoto->filepath),
            "The old photo file should not seen found");
        $this->notSeeInDatabase('photos', $oldResult);

        $this->seeInDatabase('photos', $newResult);
        $this->assertFileExists(app_storagePath($newPhoto->filepath));

        $this->restorePhotoFileToOriginalPlace($newPhoto->filepath);
        makeCopy('app\test.jpg','app\test2.jpg');
    }


    /** @test */
    function a_photo_could_only_be_saved_by_a_photoable_model()
    {
        //given
        $uploadedFile = fakeUploadedFile();
        $model = new DummyModel;

        //then
        $this->expectException(get_class(new PhotoableNotAllowedException),
            'Expect to see Exception when publish');

        $this->photoRepository->storeOrUpdate(
            $uploadedFile,
            $model);
    }


    /** @test */
    function a_photo_could_be_deleted_by_its_filepath()
    {
        //given
        $uploadedFile = fakeUploadedFile();
        $photo = $this->photoRepository->storeOrUpdate(
            $uploadedFile,
            $this->device);

        $filepath = $photo->filepath;

        //when
        $this->photoRepository->delete($photo->filepath);

        //then
        $this->assertEmpty($photo->fresh());
        $this->assertFileNotExists(app_storagePath($filepath),
            "The photo file should not seen found");

        makeCopy('app\test2.jpg','app\test.jpg');
    }


    private function restorePhotoFileToOriginalPlace($filepath)
    {
        File::move(public_path() . $filepath, storage_path('app\test.jpg'));
    }
}