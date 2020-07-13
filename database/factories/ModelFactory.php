<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AvailableKey;
use App\Contracts\HashGenerator;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(AvailableKey::class, function (Faker $faker) {
    /** @var HashGenerator $generator */
    $generator = app(HashGenerator::class);
    return [
        'hash' => $generator->generate(),
    ];
});
