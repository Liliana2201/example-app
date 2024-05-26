<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBeddingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_bedding', function (Blueprint $table) {
            $table->increments('id'); // id выдачи
            $table->integer('id_stud')->unsigned(); // id студента, кому выдали
            $table->date('date_beg'); // дата выдачи
            $table->date('date_end'); // дата сдачи
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_bedding');
    }
}
