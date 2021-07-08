<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFavoritesTable extends Migration
{
    public function up()
    {
        Schema::table('favorites', function (Blueprint $table) {
            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_fk_655303')->references('id')->on('users');

            $table->unsignedInteger('image_id')->nullable();

            $table->foreign('image_id', 'image_fk_656070')->references('id')->on('images');

            $table->unsignedInteger('sound_id')->nullable();

            $table->foreign('sound_id', 'sound_fk_656071')->references('id')->on('sounds');

            $table->unsignedInteger('video_id')->nullable();

            $table->foreign('video_id', 'video_fk_656072')->references('id')->on('videos');
        });
    }
}
