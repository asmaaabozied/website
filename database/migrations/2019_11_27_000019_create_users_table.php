<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('user_name')->nullable();
            $table->string('birth_year')->nullable();
            $table->string('gender')->nullable();
            $table->string('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('active')->default(1);
            $table->string('device_type')->nullable();
            $table->string('device_token')->nullable();
            $table->string('verfiy_code')->nullable();

            $table->string('email')->unique();

            $table->datetime('email_verified_at')->nullable();

            $table->string('password');

            $table->string('remember_token')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
