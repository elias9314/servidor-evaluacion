<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_evaluaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tipo_evaluacion_id')->nullable();
            $table->foreign('tipo_evaluacion_id')->references('id')->on('tipo_evaluaciones');
            $table->string('nombre',200);
            $table->string('evaluacion',200);
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
        Schema::dropIfExists('tipo_evaluaciones');
    }
}
