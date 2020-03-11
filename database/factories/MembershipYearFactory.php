<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\MembershipYear;

$factory->define(MembershipYear::class, function (Faker $faker) {
    return [
        'type' => 'Membership of club',
        'year' => $faker->unique()->numberBetween(2000, 2020),
        'payment' => 5,
        'active' => $faker->numberBetween(0, 1),
        'description' => $faker->paragraph(2, true),
    ];
});
