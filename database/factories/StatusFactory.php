<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Status::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
