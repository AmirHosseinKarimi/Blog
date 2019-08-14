<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::all()->each(function ($user) {
            for ($i = 0; $i < rand(3, 10); $i++) {
                $user->posts()->save(factory(\App\Post::class)->make());
            }
        });
    }
}
