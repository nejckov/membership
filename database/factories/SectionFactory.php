<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Section;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->paragraph(3, true),
        'active' => $faker->numberBetween(0,1),
    ];
});
