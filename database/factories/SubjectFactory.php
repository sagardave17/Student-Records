<?php

$factory->define(App\Subject::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "semester_id" => factory('App\Semester')->create(),
    ];
});
