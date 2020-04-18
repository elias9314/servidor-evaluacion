<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->string('tipo_identificacion', 50)->default(0);
            $table->string('identificacion', 50)->nullable()->unique();;
            $table->string('apellido1', 50)->nullable();
            $table->string('apellido2', 50)->nullable();
            $table->string('nombre1', 50)->nullable();
            $table->string('nombre2', 50)->nullable();
            $table->string('sexo', 50)->default(0);
            $table->string('correo_personal', 100)->nullable();
            $table->string('correo_institucional', 100)->nullable()->unique();
            $table->string('telefono',10);
            $table->string('imagen')->nullable();
            $table->date('fecha_nacimiento')->nullable();
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
        Schema::dropIfExists('docentes');
    }
}
