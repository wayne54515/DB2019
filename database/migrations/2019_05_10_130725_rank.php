<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rank', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id')->comment("食物ID");
            $table->integer('user_id')->comment("使用者ID");
            $table->integer('rank')->unsigned()->comment("評分");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rank');
    }
}
