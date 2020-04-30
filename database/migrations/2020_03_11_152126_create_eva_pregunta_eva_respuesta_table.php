<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaPreguntaEvaRespuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eva_pregunta_eva_respuesta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('respuestas_id')->nullable();
            $table->foreign('respuestas_id')->references('id')->on('eva_respuestas');
            $table->integer('preguntas_id')->nullable();
            $table->foreign('preguntas_id')->references('id')->on('eva_preguntas');
            $table->integer('orden')->unique();
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
        Schema::dropIfExists('eva_pregunta_eva_respuesta');
    }
}
