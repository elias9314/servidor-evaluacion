<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaRespuesta extends Model
{
    protected  $table='eva_respuestas';
    protected $fillable = [
        'codigo','orden','nombre', 'valor', 'tipo','estado'
    ];

    public function resultado()
    {
        return $this->hasMany('App\EvaPreguntaEvaRespuesta');
    }

}
