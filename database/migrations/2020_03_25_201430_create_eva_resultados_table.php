<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eva_resultados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('eva_pregunta_eva_respuesta_id')->nullable();
            $table->foreign('eva_pregunta_eva_respuesta_id')->references('id')->on('eva_pregunta_eva_respuesta');
            $table->integer('docente_asignatura_id')->nullable();
            $table->foreign('docente_asignatura_id')->references('id')->on('docente_asignaturas');
            $table->integer('estudiante_id')->nullable();
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->string('valor',500)->nullable();
            $table->string('tipo', 50)->nullable();
            $table->string('estado', 20)->default('ACTIVO');
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
        Schema::dropIfExists('eva_resultados');
    }
}
