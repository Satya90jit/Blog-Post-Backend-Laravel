<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('description', 200);
            $table->string('category');
            $table->timestamps();
            // $table->foreignId('user_id')->references('id')->on('blog_users');
            // $table->foreignId('category_id')->references('id')->on('blog_categories');
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
