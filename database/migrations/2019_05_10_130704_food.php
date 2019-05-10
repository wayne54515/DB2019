<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Food extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->comment("食物名字");
            $table->integer('price')->unsigned()->comment("價格");
            $table->string('type', 30)->comment("食物種類");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('food');
    }
}
