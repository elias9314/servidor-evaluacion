<?php

namespace App\Http\Controllers;

use App\DocenteAsignatura;
use App\Estudiante;
use App\EvaPreguntaEvaRespuesta;
use App\EvaRespuesta;
use Illuminate\Http\Request;
use App\Resultado;

class ResultadosController extends Controller
{
    public function getresultados(){
        $resultados= Resultado::with('eva_pregunta_eva_respuesta','estudiante','docente_asignatura')->get();
        return response()->json($resultados,200);
    }

    public function createresultado(Request $request){
        $data = $request->json()->all();
        $dataResultado = $data['resultados'];
        $resultados = new Resultado([
            'valor' => $dataResultado['valor'],
            'tipo' => $dataResultado['tipo'],
            'estado' => $dataResultado['estado']
        ]);
        $respuesta = EvaPreguntaEvaRespuesta::findOrFail($data['resultados']['eva_pregunta_eva_respuesta']['id']);
        $estudiante = Estudiante::findOrFail($dataResultado['estudiante']['id']);
        $docenteasignatura = DocenteAsignatura::findOrFail($dataResultado['docente_asignatura']['id']);

        $resultados->eva_pregunta_eva_respuesta()->associate($respuesta);
        $resultados->estudiante()->associate($estudiante);
        $resultados->docente_asignatura()->associate($docenteasignatura);
        $resultados->save();
        return response()->json(['resultados' => $resultados], 201);
        
    }
}
