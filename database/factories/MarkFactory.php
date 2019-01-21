<?php

$factory->define(App\Mark::class, function (Faker\Generator $faker) {
    return [
        "user_id" => factory('App\User')->create(),
        "semester_id" => factory('App\Semester')->create(),
        "subject_id" => factory('App\Subject')->create(),
        "mark" => $faker->randomNumber(2),
    ];
});
