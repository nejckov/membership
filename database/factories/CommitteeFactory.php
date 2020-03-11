<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Committee;
use App\Models\Membership\Fns;
use App\Models\Membership\Member;
use App\Models\Membership\MembershipYear;

$factory->define(Committee::class, function (Faker $faker) {
    return [
        'fns_id' => Fns::all()->random()->id,
        'member_id' => Member::all()->random()->id,
        'year' => MembershipYear::all()->random()->year,
        'description' => $faker->paragraph(2, true)
    ];
});
