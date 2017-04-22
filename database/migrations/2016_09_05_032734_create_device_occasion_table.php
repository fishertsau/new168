<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeviceOccasionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_occasion', function (Blueprint $table) {
            $table->unsignedInteger('device_id')->index();
            $table->unsignedTinyInteger('occasion_id')->index();

            $table->primary(['device_id', 'occasion_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('device_occasion');
    }
}
