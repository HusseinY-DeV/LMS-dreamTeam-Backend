<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'student_id' => 'ST-' . $faker->randomLetter . $faker->randomDigit . $faker->randomDigit,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'section_id' => function () {
            // Get random section id
            return App\Section::inRandomOrder()->first()->id;
        },
    ];
});
