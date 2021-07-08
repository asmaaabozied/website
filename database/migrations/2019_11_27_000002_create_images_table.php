<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->longText('descp')->nullable();

            $table->string('file_name')->nullable();
            $table->string('img_thm')->nullable();

            $table->integer('views')->default(0);

            $table->integer('comments')->default(0);

            $table->string('likes')->default(0);

            $table->integer('favorites')->default(0);

            $table->integer('active')->default(0);

            $table->string('dlike')->default(0);


            $table->timestamps();

            $table->softDeletes();
        });
    }
}
