<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaPreguntaEvaRespuesta extends Model
{
    protected  $table='eva_pregunta_eva_respuesta';
    protected $fillable = [
         'orden'
    ];

    public function respuestas(){
        return $this->belongsTo('App\EvaRespuesta');
    }
    public function preguntas(){
        return $this->belongsTo('App\EvaPregunta');
    }

    public function resultado(){
        return $this->hasMany('App\Resultado');
    }
}
