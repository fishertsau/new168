<?php

use Illuminate\Database\Seeder;
use App\Models\Area;
use App\Models\City;

class CityTableSeeder extends Seeder
{
    protected $cityList;
    protected $areaList;

    public function __construct()
    {
        $this->cityList = json_decode(Storage::get('city.json'))->cityList;
        $this->areaList = json_decode(Storage::get('city.json'))->areaList;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->cityList as $city) {
            $input = [
                'id' => $city->id,
                'title' => $city->title,
                'district' => $city->district
            ];
            City::create($input);
        }

        foreach ($this->areaList as $area) {
            $input = [
                'id' => $area->id,
                'city_id' => $area->city_id,
                'title' => $area->title,
                'zip' => $area->zip
            ];
            Area::create($input);
        }
    }
}
