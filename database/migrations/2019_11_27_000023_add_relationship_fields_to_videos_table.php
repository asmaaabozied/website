<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVideosTable extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->unsignedInteger('category_id');

            $table->foreign('category_id', 'category_fk_656046')->references('id')->on('categories');

            $table->unsignedInteger('sub_domain_no');

            $table->foreign('sub_domain_no', 'sub_domain_no_fk_656047')->references('id')->on('sub_domians');
        });
    }
}
