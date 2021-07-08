<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayListVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_list_videos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('paly_list_id')->nullable();
            $table->foreign('paly_list_id', 'play_lists_fk_44655297')
                ->references('id')->on('play_lists');

            $table->unsignedInteger('video_id')->nullable();
            $table->foreign('video_id', 'video_fk_44655297')
                ->references('id')->on('videos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_list_videos');
    }
}
