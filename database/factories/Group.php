<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Group;
use Faker\Generator as Faker;

$factory->define(Group::class, function (Faker $faker) {
    $groups = ['School', 'Single', 'Church'];
    return [
        'name' => $faker->unique()->randomElement($groups)
    ];
});
