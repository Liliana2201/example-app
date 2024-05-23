<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id'); //id
            $table->integer('id_category')->unsigned(); // id категории
            $table->integer('id_stud')->unsigned(); // id студента, оставившего заявку
            $table->string('description'); // описание проблемы
            $table->Integer('is_check')->default(0); // 0-не рассмотрена, 1-рассмотрена
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
        Schema::dropIfExists('applications');
    }
}
