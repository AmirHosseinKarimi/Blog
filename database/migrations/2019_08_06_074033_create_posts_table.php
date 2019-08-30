<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id');
            $table->string('title');
            $table->text('excerpt');
            $table->text('content');
            $table->string('status')->default('publish');
            $table->string('slug')->unique();
            $table->string('type')->default('post');
            $table->string('comment_status')->default('open');
            $table->unsignedBigInteger('comment_count')->default(0);
            $table->timestamp('published_at')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
