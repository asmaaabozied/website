<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_44655297')
                ->references('id')->on('users');

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
        Schema::dropIfExists('play_lists');
    }
}
