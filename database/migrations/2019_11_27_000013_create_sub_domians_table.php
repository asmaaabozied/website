<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubDomiansTable extends Migration
{
    public function up()
    {
        Schema::create('sub_domians', function (Blueprint $table) {
            $table->increments('id');

            $table->string('titleEn');

            $table->string('titleAr');

            $table->string('url');

            $table->string('username');

            $table->string('password');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
