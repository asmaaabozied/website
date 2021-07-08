<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');

            $table->string('category_name');

            $table->longText('descp')->nullable();

            $table->string('icon_img')->nullable(); //new

            $table->boolean('active')->default(0)->nullable();

            $table->boolean('is_last_level')->default(0)->nullable();

            $table->string('parent_category')->nullable();

            $table->integer('category_level')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
