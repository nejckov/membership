<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Category;
use App\Models\Membership\Competition;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'from' => $faker->numberBetween(1, 50),
        'to' => $faker->numberBetween(50, 100),
        'type' => Category::TYPE_COMPETITION,
        'type_id' => Competition::all()->random()->id,
        'participants' => $faker->numberBetween(20, 100),
    ];
});
