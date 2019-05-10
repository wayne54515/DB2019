<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Waiter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('waiter_id')->comment("服務生ID");
            $table->integer('salary')->unsigned()->comment("時薪");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('waiter');
    }
}
