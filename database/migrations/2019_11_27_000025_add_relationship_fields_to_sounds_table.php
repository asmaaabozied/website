<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSoundsTable extends Migration
{
    public function up()
    {
        Schema::table('sounds', function (Blueprint $table) {
            $table->unsignedInteger('category_id');

            $table->foreign('category_id', 'category_fk_655494')->references('id')->on('categories');

            $table->unsignedInteger('sub_domain_no')->nullable();

            $table->foreign('sub_domain_no', 'sub_domain_no_fk_655495')->references('id')->on('sub_domians');
        });
    }
}
