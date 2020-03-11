<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Doc;
use App\Models\Membership\Membershipyear;
use App\Models\Membership\Section;

$factory->define(Doc::class, function (Faker $faker) {
    return [
        'type' => Doc::TYPE,
        'reference' => $faker->unique()->numberBetween(1, 10000000),
        'membership_year_id' => Membershipyear::all()->random()->id,
        'section_id' => Section::all()->random()->id,
    ];
});
