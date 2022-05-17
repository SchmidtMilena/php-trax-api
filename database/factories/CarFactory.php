<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Car;
use Faker\Generator as Faker;
use App\Models\User;

$factory->define(Car::class, function (Faker $faker) {
    return [
        'user_id' => User::first()->id,
        'year' => $faker->time('Y'),
        'make' => $faker->word(),
        'model' => $faker->word(),
    ];
});
