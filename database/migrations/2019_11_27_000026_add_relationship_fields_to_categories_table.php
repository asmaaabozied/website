<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedInteger('category_type');

            $table->foreign('category_type', 'category_type_fk_654811')
                ->references('id')->on('categories_types');
        });
    }
}
