<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Company;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph(3, true),
    ];
});
