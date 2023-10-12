<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id_staff'); //id
            $table->string('surname'); //фамилия
            $table->string('name'); //имя
            $table->string('patronymic')->nullable(); //отчество
            $table->integer('id_post')->unsigned(); //id должности
            $table->integer('id_dom')->unsigned(); //id общежития
            $table->integer('office'); //кабинет
            $table->char('phone'); //телефон
            $table->char('email'); //почта
            $table->char('url_photo'); //ссылка на фото
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
