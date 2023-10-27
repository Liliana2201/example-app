<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id_stud'); //id
            $table->integer('id_room')->unsigned(); //id комнаты
            $table->string('surname'); //фамилия
            $table->string('name'); //имя
            $table->string('patronymic')->nullable(); //отчество
            $table->char('group'); //группа
            $table->char('series_pas'); //серия паспорта
            $table->char('number_pas'); //номер паспорта
            $table->string('issued_pas'); //кем выдан
            $table->date('date_pas'); //дата выдачи паспорта
            $table->date('date_births'); //дата рождения
            $table->string('hometown'); //родной город
            $table->integer('id_contract')->unsigned(); //номер договора
            $table->float('balance'); //баланс
            $table->char('phone'); //телефон
            $table->char('email'); //почта
            $table->integer('work_out')->default(0); //отработано часов
            $table->date('date_flg'); //дата последней флюрографии
            $table->char('url_photo'); //ссылка на фото
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
        Schema::dropIfExists('students');
    }
}
