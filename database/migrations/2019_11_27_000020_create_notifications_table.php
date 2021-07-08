<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');

            $table->string('alert_text');

            $table->string('alert_type');

            $table->string('media_number')->nullable();

            $table->string('message_details');

            $table->string('attachments_message')->nullable();

            $table->string('link')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
