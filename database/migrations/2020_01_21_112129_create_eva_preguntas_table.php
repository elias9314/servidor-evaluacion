<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaPreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eva_preguntas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tipo_evaluacion_id')->nullable();
            $table->foreign('tipo_evaluacion_id')->references('id')->on('tipo_evaluaciones');
            $table->string('codigo', 100);
            $table->integer('orden');
            $table->string('nombre', 200);
            $table->string('tipo', 50);
            $table->integer('cantidad_respuestas')->default(4);
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
        Schema::dropIfExists('eva_preguntas');
    }
}
