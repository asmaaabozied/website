<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title');

            $table->string('ads_type');

            $table->longText('code')->nullable();

            $table->string('image')->nullable(); // new

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
