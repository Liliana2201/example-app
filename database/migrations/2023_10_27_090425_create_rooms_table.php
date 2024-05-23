<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id'); //id
            $table->string('number'); // номер комнаты
            $table->integer('level'); // этаж
            $table->integer('num_beds'); // количество койко-мест
            $table->float('square'); // площадь
            $table->integer('id_cond')->unsigned(); // id состояния
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
        Schema::dropIfExists('rooms');
    }
}
