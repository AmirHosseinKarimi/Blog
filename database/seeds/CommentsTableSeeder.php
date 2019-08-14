<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add comments
        \App\Post::all()->each(function ($post) {
            if ($post->status !== 'publish' || $post->comment_status !== 'open') {
                return;
            }

            // Root comments
            for ($i = 0; $i < rand(2, 5); $i++) {
                $post->comments()->save(factory(\App\Comment::class)->make([
                    'user_id' => \App\User::inRandomOrder()->first()->id,
                ]));
            }

            // Reply comments
            for ($i = 0; $i < rand(2, 5); $i++) {
                $post->comments()->save(factory(\App\Comment::class)->make([
                    'user_id' => \App\User::inRandomOrder()->first()->id,
                    'parent_id' => \App\Comment::inRandomOrder()->first()->id,
                ]));
            }
        });

        // Count post comments
        \App\Post::all()->each(function ($post) {
            $post->comment_count = \App\Comment::where('post_id', $post->id)->count();
            $post->update();
        });
    }
}
