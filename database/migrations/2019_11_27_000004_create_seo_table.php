<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTable extends Migration
{
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->increments('id');

            $table->string('seo_title');

            $table->string('seo_keywords')->nullable();

            $table->longText('seo_description')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
