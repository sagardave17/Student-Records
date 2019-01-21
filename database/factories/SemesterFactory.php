<?php

$factory->define(App\Semester::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
