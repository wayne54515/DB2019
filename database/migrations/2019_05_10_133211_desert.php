<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Desert extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desert', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('desert_id')->comment("點心ID");
            $table->string('taste', 5)->comment("鹹甜");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('desert');
    }
}
