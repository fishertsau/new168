<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id')->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->string('verified_token', 30)->nullable();
            $table->boolean('verified')->default(false);

            $table->unsignedInteger('signIn_count')->default(0);

            $table->dateTime('signIn_at')->nullable();
            $table->dateTime('last_signIn_at')->nullable();
            $table->string('signIn_ip')->nullable();
            $table->string('last_signIn_ip')->nullable();

            $table->rememberToken();
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
        Schema::drop('users');
    }
}
