<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaundriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundries', function (Blueprint $table) {
            $table->increments('id_wash'); //id
            $table->integer('id_mash')->unsigned(); //номер машинки
            $table->date('date_wash'); //дата стирки
            $table->time('time_wash'); //время стирки
            $table->integer('id_stud')->unsigned(); //id студента
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laundries');
    }
}
