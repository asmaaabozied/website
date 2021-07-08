<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('username');

            $table->string('password');

            $table->string('permission')->nullable();

            $table->string('email');

            $table->boolean('active')->default(0)->nullable();

            $table->date('last_login')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
