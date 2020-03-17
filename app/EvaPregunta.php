<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaPregunta extends Model
{
    protected $fillable = [
        'codigo', 'orden', 'nombre', 'tipo','cantidad','estado'
    ];

    public function TipoEvaluacion()
    {
        return $this->belongsTo('App\TipoEvaluacion');
    }
}
