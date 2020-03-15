<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eva_respuestas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('codigo', 100);
            $table->integer('orden');
            $table->string('nombre', 200);
            $table->string('valor', 200);
            $table->string('tipo', 100);
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
        Schema::dropIfExists('eva_respuestas');
    }
}
