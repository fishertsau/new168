<?php

use App\Models\Occasion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class OccasionTableSeeder extends Seeder
{
    protected $occasionList;

    public function __construct()
    {
        $this->occasionList = json_decode(Storage::get('occasions.json'));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->occasionList as $occasion) {
            factory(Occasion::class)->create(['title' => $occasion->title]);
        }
    }
}
