<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Fns;

$factory->define(Fns::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(2, true),
    ];
});
