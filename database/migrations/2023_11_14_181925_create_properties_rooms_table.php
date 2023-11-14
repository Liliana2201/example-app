<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_rooms', function (Blueprint $table) {
            $table->increments('id'); //id
            $table->integer('rooms_id')->unsigned(); //id комнаты
            $table->integer('properties_id')->unsigned(); // id имущества
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
        Schema::dropIfExists('properties_rooms');
    }
}
