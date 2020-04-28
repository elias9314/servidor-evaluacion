<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Docente extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'identificacion',
        'apellido1',
        'apellido2',
        'nombre1',
        'nombre2',
        'correo_institucional',
        'correo_personal',
        'fecha_nacimiento',
        'sexo',
        'estado',
        'telefono',
        'tipo_identificacion',
        'imagen'
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
    public function docenteasignatura()
    {
        return $this->hasMany('App\DocenteAsignatura');
    }
}
