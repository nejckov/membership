<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Membership;
use App\Models\Membership\Member;
use App\Models\Membership\MembershipYear;
use App\User;
use App\Models\Membership\Doc;

$factory->define(Membership::class, function (Faker $faker) {

    $doc = Doc::all()->random();

    return [
        'member_id' => Member::all()->random()->id,
        'doc_id' => $doc->id,
        'membership_year_id' => MembershipYear::all()->random()->id, //$doc->membership_year_id,
        'user_id' => User::all()->random()->id,
    ];
});
