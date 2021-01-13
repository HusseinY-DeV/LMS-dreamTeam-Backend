<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classe;
use Faker\Generator as Faker;

$factory->define(App\Classe::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
