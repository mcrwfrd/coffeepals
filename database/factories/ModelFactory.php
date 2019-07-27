<?php

use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
    ];
});

$factory->define(App\Organization::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->safeEmail,
        'password' => Hash::make('secret'),

    ];
});
