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
        \App\Post::all()->each(
            function ($post) {
                if ($post->status !== 'publish' || $post->comment_status !== 'open') {
                    return;
                }

                // Comments without parent
                for ($i = 0; $i < rand(2, 5); $i++) {
                    if (rand(0, 1)) {
                        $post->comments()->save(factory(\App\Comment::class)->make([
                        'user_id' => \App\User::inRandomOrder()->first()->id,
                        'author_name' => '',
                        'author_email' => '',
                        'author_website' => '',
                        ]));
                    } else {
                        $post->comments()->save(factory(\App\Comment::class)->make());
                    }
                }

                // Reply comments
                for ($i = 0; $i < rand(2, 5); $i++) {
                    if (rand(0, 1)) {
                        $post->comments()->save(factory(\App\Comment::class)->make([
                        'user_id' => \App\User::inRandomOrder()->first()->id,
                        'parent_id' => \App\Comment::inRandomOrder()->first()->id,
                        'author_name' => '',
                        'author_email' => '',
                        'author_website' => '',
                        ]));
                    } else {
                        $post->comments()->save(factory(\App\Comment::class)->make([
                        'parent_id' => \App\Comment::inRandomOrder()->first()->id,
                        ]));
                    }
                }
            }
        );

        \App\Post::all()->each(function ($post) {
            $post->comment_count = \App\Comment::where('post_id', $post->id)->count();
            $post->update();
        });
    }
}
