<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cook extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cook', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cook_id')->comment("廚師ID");
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
        Schema::drop('cook');
    }
}
