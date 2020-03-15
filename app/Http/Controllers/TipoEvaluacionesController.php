<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEvaluacion;
class TipoEvaluacionesController extends Controller
{
    public function getTipoEvaluacion(){
        $evaluacion= TipoEvaluacion::all();
        return response()->json([$evaluacion],200);
    }
}
