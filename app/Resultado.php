<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    protected  $table='eva_resultados';
    protected $fillable = [
        'valor', 'tipo', 'estado'
    ];

    public function estudiante()
    {
        return $this->belongsTo('App\Estudiante');
    }

    public function docente_asignatura()
    {
        return $this->belongsTo('App\DocenteAsignatura');
    }

    public function eva_pregunta_eva_respuesta(){
        return $this->belongsTo('App\EvaPreguntaEvaRespuesta');
    }

}
