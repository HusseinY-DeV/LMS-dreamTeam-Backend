<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'number_of_students' => '10',
        'class_id' => function () {
            // Get random class id
            return App\Classe::inRandomOrder()->first()->id;
        },
    ];
});
