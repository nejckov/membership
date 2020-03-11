<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

use App\Models\Membership\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->numberBetween(1, 100000),
        'name' => $faker->city(),
        'description' => $faker->paragraph(4, true),
    ];
});
