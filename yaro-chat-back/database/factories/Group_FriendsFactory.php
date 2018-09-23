<?php

use Faker\Generator as Faker;

$factory->define(App\Group_Friends::class, function (Faker $faker) {
    return [
        'user_id'  => App\User::all()->random()->id,
        'group_id'  => App\Group::all()->random()->id,
    ];
});
