<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $status = $faker->randomElement(['publish', 'publish', 'publish', 'draft']);
    return [
        'title' => $faker->sentence(),
        'excerpt' => $faker->realText(),
        'content' => $faker->paragraphs(5, true),
        'status' => $status,
        'slug' => $faker->slug,
        'type' => 'post',
        'comment_status' => $faker->randomElement(['open', 'close']),
        'published_at' => ($status === 'publish') ? \Carbon\Carbon::now()->toDateTimeString() : null,
    ];
});
