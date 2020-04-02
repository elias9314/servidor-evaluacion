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
        'estado'
    ];
    public function docente()
    {
        return $this->belongsTo('App\Docente');
    }
    }