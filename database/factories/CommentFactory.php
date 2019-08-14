<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'author_name' => $faker->firstName,
        'author_email' => $faker->unique()->safeEmail,
        'author_url' => $faker->url,
        'author_ip' => $faker->ipv4,
        'author_agent' => $faker->userAgent,
        'content' => $faker->realText(),
        'status' => $faker->randomElement(['waiting', 'approved', 'rejected']),
    ];
});
