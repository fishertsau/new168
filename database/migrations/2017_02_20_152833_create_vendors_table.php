<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();

            $table->boolean('published')->default(false);
            $table->string('type')->nullable();
            $table->string('title');

            $table->text('description')->nullable();

            //contact
            $table->string('telephone')->nullable();;
            $table->string('fax')->nullable();;
            $table->string('url')->nullable();
            $table->string('fbUrl')->nullable();
            $table->string('contact')->nullable();
            $table->string('email')->nullable();

            //service
            $table->boolean('could_maintain')->default(false);
            $table->string('maintenance_items')->nullable();

            $table->string('services')->nullable();
            $table->string('service_areas')->nullable();
            $table->string('service_time')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
