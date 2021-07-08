<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->longText('descp')->nullable();

            $table->string('duration')->nullable();

            $table->integer('views')->default(0);

            $table->integer('comments')->default(0);

            $table->integer('likes')->default(0);

            $table->integer('favorites')->default(0);

            $table->boolean('active')->default(0)->nullable();

            $table->integer('dlike')->default(0);

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
