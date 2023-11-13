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
            $table->increments('id'); //id
            $table->integer('id_room')->unsigned(); //id комнаты
            $table->string('surname'); //фамилия
            $table->string('name'); //имя
            $table->string('patronymic')->nullable(); //отчество
            $table->string('group'); //группа
            $table->string('passport'); //серия и номер паспорта
            $table->string('issued_pas'); //кем выдан
            $table->date('date_pas'); //дата выдачи паспорта
            $table->date('date_births'); //дата рождения
            $table->string('hometown'); //родной город
            $table->string('contract'); //ссылка на договор
            $table->float('balance')->default(0); //баланс
            $table->string('phone'); //телефон
            $table->string('email'); //почта
            $table->integer('work_out')->default(0); //отработано часов
            $table->date('date_flg'); //дата последней флюрографии
            $table->string('photo'); //ссылка на фото
            $table->integer('id_prop')->unsigned(); //id имущества
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
        Schema::dropIfExists('students');
    }
}
