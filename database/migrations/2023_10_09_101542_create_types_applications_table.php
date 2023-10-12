<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types_applications', function (Blueprint $table) {
            $table->increments('id_category'); //id
            $table->string('name_category'); //название категории
            $table->integer('id_post')->unsigned(); //id должности, кому отправляется заявка
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types_applications');
    }
}
