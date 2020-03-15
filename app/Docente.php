<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Docente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'apellido1',
        'apellido2',
        'correo_institucional',
        'correo_personal',
        'estado',
        'fecha_nacimiento',
        'sexo',
        'identificacion',
        'nombre1',
        'nombre2',
        'tipo_identificacion',
    ];

    public function matriculas()
    {
        return $this->hasMany('App\Matricula');
    }

    public function canton_nacimiento()
    {
        return $this->belongsTo('App\Ubicacion');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
