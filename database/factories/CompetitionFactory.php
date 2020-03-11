<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Competition;
use App\Models\Membership\Company;

$factory->define(Competition::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'competition_date' => $faker->dateTimeBetween('2015-1-1', '2025-1-1'),
        'competition_time' => '9:00',
        'place' => $faker->city(),
        'company_id' => Company::all()->random()->id,
        'payment' => $faker->numberBetween(10, 200),
        'description' => $faker->paragraph(3, true),
    ];
});
