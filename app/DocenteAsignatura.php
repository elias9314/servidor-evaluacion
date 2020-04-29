<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DocenteAsignatura extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'paralelo',
        'jornada',
        'estado',
        'nota_total',
        'porcentaje'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
    public function resultados()
    {
        return $this->hasMany('App\Resultado');
    }
    public function asignatura()
    {
        return $this->belongsTo('App\Asignatura');
    }
     public function periodoLectivo()
    {
        return $this->belongsTo('App\PeriodoLectivo');
    }
    }
