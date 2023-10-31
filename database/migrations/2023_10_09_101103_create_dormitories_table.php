<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDormitoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dormitories', function (Blueprint $table) {
            $table->increments('id_dom'); //id
            $table->string('title_dom'); //название
            $table->string('address'); //адрес общежития
            $table->char('phone'); //номер вахты
            $table->char('url_photo')->nullable(); //ссылка на фото
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dormitories');
    }
}
