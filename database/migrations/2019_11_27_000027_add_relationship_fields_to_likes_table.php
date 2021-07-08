<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLikesTable extends Migration
{
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->unsignedInteger('image_id')->nullable();

            $table->foreign('image_id', 'image_fk_655286')->references('id')->on('images');

            $table->unsignedInteger('comment_id')->nullable();

            $table->foreign('comment_id', 'comment_fk_655296')->references('id')->on('comments');

            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('user_id', 'user_fk_655297')->references('id')->on('users');

            $table->unsignedInteger('sound_id')->nullable();

            $table->foreign('sound_id', 'sound_fk_656068')->references('id')->on('sounds');

            $table->unsignedInteger('video_id')->nullable();

            $table->foreign('video_id', 'video_fk_656069')->references('id')->on('videos');
        });
    }
}
