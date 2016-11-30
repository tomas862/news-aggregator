<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feed_model_id')->unsigned();
            $table->integer('category_id');
            $table->timestamps();
            $table->foreign('feed_model_id')->references('id')->on('feed')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feed_category');
    }
}
