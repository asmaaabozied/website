<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('like_type')->nullable(); // 1 = like        2 = dislike

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
