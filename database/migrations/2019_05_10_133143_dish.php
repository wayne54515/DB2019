<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dish extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dish_id')->comment("主餐ID");
            $table->integer('spice')->comment("辣度");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dish');
    }
}
