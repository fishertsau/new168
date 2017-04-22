<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateDevicesTable
 */
class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $dimensionDefault = '{"width":"","height":"","depth":""}';

        Schema::create('devices', function (Blueprint $table) use ($dimensionDefault) {

            $table->increments('id')->index();
            $table->unsignedInteger('user_id')->index();

            //controlled term
            $table->boolean('published')->nullable();
//            $table->date('due_until')->nullable();

            //basic information
            $table->unsignedTinyInteger('cat_id');
            $table->char('sn', 10)->index();
            $table->string('title');
            $table->string('brand', 30)->default('');
            $table->string('model', 30)->default('');

            //business term
            $table->unsignedMediumInteger('price')->default(0);
            $table->string('price_note', 10)->default('');
            $table->string('transaction', 10)->default('');
            $table->unsignedMediumInteger('deposit')->default(0);
            $table->string('transportation', 10)->default('');
            $table->unsignedMediumInteger('freight')->default(0);

            //device status
            $table->boolean('is_new')->default(true);
            $table->string('used_time')->default('');

            //reads number
            $table->unsignedSmallInteger('reads')->default(0);

            //spec + frequent use specs
            $table->string('gas_type')->default('');
            $table->string('voltage')->default('');
            $table->string('dimension')->default($dimensionDefault);
            $table->string('specs')->default('');

            //contact info
            $table->string('contact_name')->default('');
            $table->string('contact_email')->default('');
            $table->string('contact_tel')->default('');
            $table->string('contact_role')->default('');
            $table->string('contact_line_id')->default('');

            //description
            $table->string('description')->default('');

            //used condition and guarantee
            $table->string('used_condition')->default('');
            $table->string('guarantee')->default('');

            $table->timestamps();

            //foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');

            //location
            $table->smallInteger('city')->default(0);
            $table->smallInteger('zip')->default(0);
            $table->string('street')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('devices');
    }
}
