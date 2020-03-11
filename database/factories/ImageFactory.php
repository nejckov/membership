<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Image;
use App\Models\Membership\Competition;
use App\User;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'src' => $faker->image('public/storage',640,480, null, false),
        'description' => $faker->paragraph(1, true),
        'user_id' => User::all()->random()->id,
        'type' => Image::TYPE_COMPETITION,
        'type_id' => Competition::all()->random()->id,
    ];
});
