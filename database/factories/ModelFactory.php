<?php


use Acme\Tool\Discussionable\Models\Discussion;
use App\User;
use App\Models\Vendor;
use App\Models\Occasion;
use App\Models\Device\Device;

$factory->define(User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->state(User::class, 'verified', function () {
    return [
        'verified' => true
    ];
});

$factory->state(User::class, 'unverified', function () {
    return [
        'verified' => false
    ];
});


$factory->define(Occasion::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'active' => true,
    ];
});


$factory->define(Device::class, function (Faker\Generator $faker) {
    $user_length = (User::all()->count()) ? User::all()->count() : 1;
    return [
        'user_id' => random_int(1, $user_length),
        'cat_id' => 0,
        'title' => $faker->firstName,
    ];
});


$factory->state(Device::class, 'published', function () {
    return [
        'published' => true
    ];
});

$factory->state(Device::class, 'unpublished', function () {
    return [
        'published' => false
    ];
});


$factory->define(Vendor::class, function (Faker\Generator $faker) {
    $user_length = (User::all()->count()) ? User::all()->count() : 1;
    return [
        'user_id' => random_int(1, $user_length),
        'title' => $faker->firstName,
        'type' => array_rand(['個人', '行號', '公司']),
    ];
});

$factory->state(Vendor::class, 'published', function () {
    return [
        'published' => true
    ];
});

$factory->state(Vendor::class, 'unpublished', function () {
    return [
        'published' => false
    ];
});

$factory->define(Discussion::class, function (Faker\Generator $faker) {
//    $user_length = (User::all()->count()) ? User::all()->count() : 1;
    return [
        'user_id' => random_int(1, 5),
        'content' => $faker->paragraph,
        'discussionable_id' => random_int(1, 5),
        'discussionable_type' => 'someModel'
    ];
});