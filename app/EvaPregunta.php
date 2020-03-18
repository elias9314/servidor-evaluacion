<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaPregunta extends Model
{
    protected $fillable = [
        'codigo', 'orden', 'nombre', 'tipo','cantidad','estado','tipo_evaluacion_id'
    ];

    public function tipo_evaluacion()
    {
        return $this->belongsTo('App\TipoEvaluacion');
    }
}
