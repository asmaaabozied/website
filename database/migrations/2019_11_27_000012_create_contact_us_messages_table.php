<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('contact_us_messages', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->nullable();

            $table->longText('content');

            $table->string('from_u');

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->integer('readed')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
