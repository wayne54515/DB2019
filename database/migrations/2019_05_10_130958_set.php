<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Set extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dish_id')->comment("主餐ID");
            $table->integer('dish_num')->unsigned()->comment("主餐數量");
            $table->integer('desert_id')->comment("點心ID");
            $table->integer('desert_num')->unsigned();
            $table->integer('beverage_id')->comment("飲料ID");
            $table->integer('beverage_num')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('set');
    }
}
