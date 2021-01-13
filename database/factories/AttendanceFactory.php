<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attendance;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTime,
        'section_id' => function () {
            // Get random section id
            return App\Section::inRandomOrder()->first()->id;
        },
    ];
});
