<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Trade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('food_id')->comment("食物ID");
            $table->integer('table_id')->comment("桌號");
            $table->integer('number')->unsigned()->comment("購買數量");
            $table->dateTime('created_at')->comment("交易時間");
            $table->dateTime('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trade');
    }
}
