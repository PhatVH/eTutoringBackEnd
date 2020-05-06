<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tutor;
use Faker\Generator as Faker;

$factory->define(Tutor::class, function (Faker $faker) {
    return [
        //
        'tutor_name' => $faker->name,
        'tutor_phone' => $faker->unique()->phoneNumber,
        'tutor_email' => $faker->unique()->email
    ];
});
