<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiosTable extends Migration
{
    public function up()
    {
        Schema::create('radios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('name')->nullable();
            $table->string('file');
            $table->timestamps();
            $table->softDeletes();
        });

    }
}
