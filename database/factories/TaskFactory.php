<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'status_id' => function () {
            return factory(App\Status::class)->create()->id;
        },
        'creator_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'assignedto_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
