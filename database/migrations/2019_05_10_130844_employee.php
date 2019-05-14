<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->comment("員工姓名");
            $table->string('sex', 10)->comment("性別");
            $table->integer('work_time')->unsigned()->comment("一日工作時長");
            $table->integer('work_day')->unsigned()->comment("工作日數");
            $table->integer('salary')->unsigned()->comment("時薪");
            $table->string('type', 30)->comment("員工種類");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employee');
    }
}
