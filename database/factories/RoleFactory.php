<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->paragraph(3, true),
    ];
});
