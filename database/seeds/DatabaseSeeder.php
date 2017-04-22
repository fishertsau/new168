<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    private $tables = [
        'users',
        'occasions',
        'sub_groups',
        'groups',
        'addresses',
        'devices',
    ];

    private $systemSetting = true;
    private $testing = false;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->registerToBeCleaneTables();

        $this->cleanDatabase();

        if ($this->systemSetting) {
            $this->call('SystemConfigTableSeeder');
            $this->call('CityTableSeeder');
        }

        $this->call('UserTableSeeder');

        if (!$this->testing) {
            $this->call('AdminSeeder');
            $this->call('OccasionTableSeeder');
            $this->call('DeviceGroupTableSeeder');
            $this->call('DeviceTableSeeder');
        }

        Model::reguard();
    }

    private function registerToBeCleaneTables()
    {
        if ($this->systemSetting) {
            array_unshift($this->tables, 'system_config');
            array_unshift($this->tables, 'taiwan_city');
        }

        if ($this->testing) {

        }
    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName) {

            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
