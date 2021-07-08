<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('parent_comment_id')->nullable();

            $table->longText('comment');

            $table->boolean('active')->default(0)->nullable();

            $table->integer('likes')->nullable();

            $table->integer('dlike')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
