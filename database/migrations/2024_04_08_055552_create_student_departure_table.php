<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDepartureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_departure', function (Blueprint $table) {
            $table->increments('id'); // id отъездов
            $table->integer('id_stud')->unsigned(); // id студента
            $table->date('date_beg'); // дата отбытия
            $table->date('date_end'); // дата прибытия
            $table->string('reason'); // причина
            $table->string('statement'); // заявление
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_departure');
    }
}
