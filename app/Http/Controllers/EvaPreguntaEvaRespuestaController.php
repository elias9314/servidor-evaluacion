<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaPreguntaEvaRespuesta;
use App\PeriodoLectivo;

use Illuminate\Support\Facades\DB;
class EvaPreguntaEvaRespuestaController extends Controller
{
    public function getPreguntaRespuesta(){
        $preguntaresultado =EvaPreguntaEvaRespuesta::with('respuestas','preguntas')->get();
        return response()->json($preguntaresultado,200);
    }

    public function getEvaPreguntasEvaRespuestas(Request $request){

        $evaPreguntas = DB::select( "select distinct
                 eva_pregunta_eva_respuesta.id as eva_pregunta_eva_respuesta_id,
                 eva_preguntas.orden as orden,
                 eva_preguntas.nombre as pregunta,
                 eva_preguntas.id as idPregunta,
                 eva_respuestas.valor as valor,
                 eva_respuestas.nombre,
                 eva_respuestas.id from eva_preguntas
                 inner join tipo_evaluaciones on tipo_evaluaciones.id = eva_preguntas.tipo_evaluacion_id
                 inner join eva_pregunta_eva_respuesta on eva_preguntas.id = eva_pregunta_eva_respuesta.eva_pregunta_id
                 inner join eva_respuestas on eva_respuestas.id = eva_pregunta_eva_respuesta.eva_respuesta_id
                 WHERE tipo_evaluaciones.evaluacion='".$request->tipo_evaluacion."' and eva_preguntas.estado='ACTIVO'
                 and eva_respuestas.estado='ACTIVO' order by eva_preguntas.orden");
 
         return response()->json($evaPreguntas,200);
     }
}
