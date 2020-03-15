<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoEvaluacion extends Model
{
    protected  $table='tipo_evaluaciones';        
    protected $fillable = [
        'nombre', 'evaluacion', 'estado',
    ];
}
