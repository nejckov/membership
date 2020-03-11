<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\MembershipSection;
use App\Models\Membership\Membership;
use App\Models\Membership\Section;

$factory->define(MembershipSection::class, function (Faker $faker) {
    return [
        'section_id' => Section::all()->random()->id,
        'membership_id' => Membership::all()->random()->id,
   ];
});
