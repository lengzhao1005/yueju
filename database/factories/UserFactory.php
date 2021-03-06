<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\User::class, function (Faker $faker) {
    static $password;
    $now = \Carbon\Carbon::now()->toDateTimeString();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => 123456,
        'remember_token' => str_random(10),
        'is_admin'=>0,
        'is_active'=>1,
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
