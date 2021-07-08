<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminmenuTable extends Migration
{
    public function up()
    {
        Schema::create('adminmenu', function (Blueprint $table) {
            $table->increments('id');

            $table->string('menuTitleEn')->nullable();

            $table->string('menuTitleAr');

            $table->string('menuLink');

            $table->string('menuIco')->nullable();

            $table->integer('parentMenuID')->nullable();

            $table->integer('ordering')->nullable();

            $table->boolean('visable')->default(1)->nullable();

            $table->integer('member')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
