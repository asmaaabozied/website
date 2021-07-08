<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedInteger('image_id')->nullable();

            $table->foreign('image_id', 'image_fk_655100')->references('id')->on('images');

            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('user_id', 'user_fk_655104')->references('id')->on('users');

            $table->unsignedInteger('sound_id')->nullable();

            $table->foreign('sound_id', 'sound_fk_656066')->references('id')->on('sounds');

            $table->unsignedInteger('video_id')->nullable();

            $table->foreign('video_id', 'video_fk_656067')->references('id')->on('videos');
        });
    }
}
