<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AccessCode;
use Faker\Generator as Faker;

$factory->define(AccessCode::class, function (Faker $faker) {
    $duration = array(3, 6, 9, 12, 1, 2);
    $group = App\Group::pluck('id');
    return [
        'group_id' => $faker->randomElement($group),
        'name' => $faker->title,
        'code' => $faker->bankAccountNumber,
        'books_contained'  => '',
        'max_number_of_users'  => rand(1, 50),
        'duration' => $duration[rand(0, 5)],
        'price' => rand(500, 10000)."00"
    ];
});
