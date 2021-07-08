<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('keyEn');

            $table->longText('value');

            $table->string('keyAr');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
