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
            $table->string('sex', 5)->comment("性別");
            $table->string('birthday', 30)->comment("生日");
            $table->integer('work_time')->comment("一月工作時長");
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
