<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id'); //id
            $table->string('category'); // категория имущества (для комнаты или для студента)
            $table->string('title'); //название имущества
            $table->string('mark'); //маркировка
            $table->integer('year'); // год
            $table->integer('status')->default(0); // 0-свободно, 1-выдано, 2-cписано
            $table->date('date_del')->nullable(); //дата удаления
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
