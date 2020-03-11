<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Result;
use App\Models\Membership\Category;

$factory->define(Result::class, function (Faker $faker) {
    return [
        'place' => (string) $faker->numberBetween(1, 25),
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'result' => '13:00',
        'type' => Result::TYPE_CATEGORY,
        'type_id' => Category::all()->random()->id,
    ];
});
