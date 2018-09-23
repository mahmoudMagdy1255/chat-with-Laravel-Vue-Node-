<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => 'groups/default.png',
    ];
});
