<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_rooms', function (Blueprint $table) {
            $table->integer('id_dom'); //id общежития
            $table->integer('num_room'); //номер комнаты
            $table->integer('level'); //этаж
            $table->integer('num_beds'); //количество мест
            $table->integer('id_cond')->unsigned(); //id состояния комнаты
            $table->integer('id_prop')->unsigned(); //id имущества
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_rooms');
    }
}
