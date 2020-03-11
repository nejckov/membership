<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Comment;
use App\Models\Membership\Competition;
use App\User;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph(1, true),
        'user_id' => User::all()->random()->id,
        'type' => Comment::TYPE_COMPETITION,
        'type_id' => Competition::all()->random()->id,
    ];
});
