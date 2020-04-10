<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaPreguntaEvaRespuesta;
class EvaPreguntaEvaRespuestaController extends Controller
{
    public function getPreguntaRespuesta(){
        $preguntaresultado =EvaPreguntaEvaRespuesta::with('respuestas','preguntas')->get();
        return response()->json($preguntaresultado,200);
    }
}
