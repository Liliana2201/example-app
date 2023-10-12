<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id_news'); //id
            $table->integer('id_dom')->unsigned(); //id общежития
            $table->string('title_news'); //заголовок новости
            $table->text('content'); //содержание
            $table->text('description'); //краткое описание
            $table->integer('id_tag')->unsigned(); //id тэга
            $table->string('url_photo')->nullable(); //ссылки на фото и видео
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
