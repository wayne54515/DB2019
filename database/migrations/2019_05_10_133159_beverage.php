<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Beverage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beverage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('beverage_id')->comment("飲料ID");
            $table->integer('ice')->unsigned()->comment("冰塊");
            $table->integer('sweet')->unsigned()->comment("甜度");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('beverage');
    }
}
