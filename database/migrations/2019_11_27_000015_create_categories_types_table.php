<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTypesTable extends Migration
{
    public function up()
    {
        Schema::create('categories_types', function (Blueprint $table) {
            $table->increments('id');

            $table->string('type');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
