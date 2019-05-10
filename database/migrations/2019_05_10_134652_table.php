<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('table_id')->unsigned()->comment("桌號");
            $table->integer('waiter_id')->comment("服務生ID");
            $table->integer('user_id')->comment("客人ID");
            $table->integer('capacity')->unsigned()->comment("乘坐人數");
            $table->dateTime('created_at')->comment("用餐時間");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('table');
    }
}
