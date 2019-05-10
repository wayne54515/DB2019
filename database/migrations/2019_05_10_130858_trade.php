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
            $table->integer('user_id')->comment("點餐者ID");
            $table->integer('number')->unsigned()->comment("購買數量");
            $table->dateTime('created_at')->comment("交易時間");
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
