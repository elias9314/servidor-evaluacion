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
            $table->integer('eva_respuesta_id')->nullable();
            $table->foreign('eva_respuesta_id')->references('id')->on('eva_respuestas');
            $table->integer('eva_pregunta_id')->nullable();
            $table->foreign('eva_pregunta_id')->references('id')->on('eva_preguntas');
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
