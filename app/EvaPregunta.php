<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaPregunta extends Model
{
    protected $fillable = [
        'codigo', 'orden', 'nombre', 'tipo','cantidad','estado'
    ];

    public function tipo_evaluacion()
    {
        return $this->belongsTo('App\TipoEvaluacion');
    }
    public function resultado()
    {
        return $this->hasMany('App\EvaPreguntaEvaRespuesta');
    }
}
