<?php

use App\Models\Device\DeviceGroup;
use Illuminate\Database\Seeder;

class DeviceGroupTableSeeder extends Seeder
{
    protected $deviceGrpList;

    public function __construct()
    {
        $this->deviceGrpList = json_decode(Storage::get('deviceGrp.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->deviceGrpList as $deviceGrp) {
            $grp = DeviceGroup::create(["title" => $deviceGrp->title, "description" => ""]);
            foreach ($deviceGrp->items as $subGrp) {
                $grp->addSubMember(["title" => $subGrp->title, "description" => ""]);
            }
        }
    }
}
