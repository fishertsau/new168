<?php

use App\Models\Area;
use App\Models\City;
use App\Repository\PhotoRepository;
use App\Models\Device\Device;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DeviceTableSeeder extends Seeder
{
//    protected $titlePrefix = ['超級無敵', '全功能', '多功能', '全球進化', '超級省電'];
//    protected $titlePostfix = ['冰箱', '咖啡機', '牛排機', '洗碗機', '切肉機'];
//
//    protected $titlePrefix_len;
//    protected $titlePostfix_len;
//
//    protected $new_created_qyt = 10;
//
//    /**
//     * @var \Faker\Generator
//     */
//    protected $faker;
//
//    /**
//     * DeviceTableSeeder constructor.
//     * @param \Faker\Generator $faker
//     * @internal param int $titlePrefix_len
//     * @internal param int $tiltlePostfix_len
//     */
//    public function __construct(Faker\Generator $faker)
//    {
//        $this->titlePrefix_len = collect($this->titlePrefix)->count();
//        $this->tiltlePostfix_len = collect($this->titlePostfix)->count();
//        $this->faker = $faker;
//    }


//    public function run()
//    {
//        for ($i = 0; $i < $this->new_created_qyt; $i++) {
//
//            $index_prefix = random_int(0, $this->titlePrefix_len - 1);
//            $index_postfix = random_int(0, $this->titlePrefix_len - 1);
//
//            $title =
//                $this->titlePrefix[$index_prefix] .
//                $this->titlePostfix[$index_postfix];
//
//            $device = factory(Device::class)->create(['title' => $title]);
//
//            $this->add_in_address($device);
//        }
//    }

    /**
     * @var \Faker\Generator
     */
    protected $faker;
    protected $photoRepository;

    protected $deviceList;
    protected $demoDeviceIdList = [];
    protected $userCount;

    public function __construct(Faker\Generator $faker, PhotoRepository $photoRepository)
    {
        $this->deviceInputList = json_decode(Storage::get('devices.json'));
        $this->faker = $faker;
        $this->photoRepository = $photoRepository;
        $this->userCount = User::all()->count();
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->deleteOldDevicePhotos();

        foreach ($this->deviceInputList as $deviceInput) {
            $user = Auth::loginUsingId(random_int(1, $this->userCount));
            $device = $user->devices()->create($this->generateInput($deviceInput));
            $this->savePhotos($device, $deviceInput);

            //put in address
            //put in occasions by random
            //put in contact

            $this->recordDeviceId($device);
//            $device->publish();
        }

        $this->saveList($this->demoDeviceIdList);
    }

    private function recordDeviceId($device)
    {
        $this->demoDeviceIdList[] = $device->id;
    }

    private function saveList($list = [])
    {
        if (!is_array($list)) {
            $list = [$list];
        }

        $filename = storage_path() . '/app/demoDeviceIdList_' . date('y-m-d') . '.json';
        File::put($filename, collect($list)->toJson());
    }

    private function deleteOldDevicePhotos()
    {
        $directory = public_path() . '/images/devices';
        File::deleteDirectory($directory);
    }

    private function generateInput($deviceInput)
    {
        $dimension = ['width' => '', 'height' => '', 'depth' => ''];

        $city = random_int(1, City::all()->count());
        $zip = Area::where('city_id', $city)->get()->random()->id;

        return [
            'cat_id' => $deviceInput->cat_id,
            'title' => $deviceInput->title,
            'price' => $this->faker->numberBetween(300, 60000),
            'dimension' => $dimension,
            'published' => true,
            'city' => $city,
            'zip' => $zip
        ];
    }


    private function savePhotos(Device $device, $deviceInput)
    {
        foreach ($deviceInput->photos as $photo) {
            $newFilepath = $this->makePhotoCopy($photo);
            $this->storePhoto($device, $photo, $newFilepath);
        }
    }

    private function makePhotoCopy($photo)
    {
        $originalFilename = 'app/images/devices/' . $photo->filename;
        $newFilepath = 'app/images/temp/' . $photo->filename;
        makeCopy($originalFilename, $newFilepath);

        return $newFilepath;
    }

    private function storePhoto(Device $device, $photo, $newFilepath)
    {
        $this->photoRepository->storeOrUpdate(
            mimicUploadedFile($newFilepath, $photo->filename),
            $device,
            $photo->field);
    }
}
