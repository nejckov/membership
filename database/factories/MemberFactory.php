<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Member;
use App\Models\Membership\Post;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'custom_number' => $faker->unique()->numberBetween(1, 10000),
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'address' => $faker->address,
        'mobile' => $faker->phoneNumber,
        'email' => $faker->email,
        'birthdate' => $faker->dateTimeBetween('1919-1-1', '2015-1-1'),
        'post_id' => Post::all()->random()->id,
        'gender' => $faker->randomElement(['m', 'f']),
    ];
});
