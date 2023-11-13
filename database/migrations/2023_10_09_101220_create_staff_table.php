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
            $table->increments('id'); //id
            $table->string('surname'); //фамилия
            $table->string('name'); //имя
            $table->string('patronymic')->nullable(); //отчество
            $table->integer('id_post')->unsigned(); //id должности
            $table->integer('id_dom')->unsigned(); //id общежития
            $table->integer('office'); //кабинет
            $table->string('phone'); //телефон
            $table->string('email'); //почта
            $table->string('photo'); //ссылка на фото
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
        Schema::dropIfExists('staff');
    }
}
