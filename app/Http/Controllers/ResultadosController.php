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

    // public function createresultado(Request $request){
    //     $data = $request->json()->all();
    //     $dataResultado = $data['resultados'];
    //     $resultados = new Resultado([
    //         'valor' => $dataResultado['valor'],
    //         'tipo' => $dataResultado['tipo'],
    //         'estado' => $dataResultado['estado']
    //     ]);
    //     $respuesta = EvaPreguntaEvaRespuesta::findOrFail($data['resultados']['eva_pregunta_eva_respuesta']['id']);
    //     $estudiante = Estudiante::findOrFail($dataResultado['estudiante']['id']);
    //     $docenteasignatura = DocenteAsignatura::findOrFail($dataResultado['docente_asignatura']['id']);

    //     $resultados->eva_pregunta_eva_respuesta()->associate($respuesta);
    //     $resultados->estudiante()->associate($estudiante);
    //     $resultados->docente_asignatura()->associate($docenteasignatura);
    //     $resultados->save();
    //     return response()->json(['resultados' => $resultados], 201);
        
    // }

    public function getIdDocenteAsignatura(Request $request)
    {
        $asignaturaDocente = DocenteAsignatura::where('docente_id',$request->id)->first();
        $asignatura = DocenteAsignatura::where('asignatura_id',$request->asignatura_id)->get();
            return response()->json(['docenteAsignatura'=>$asignatura],200);
    }
    
    public function createresultado(Request $request)
    {
        $data = $request->json()->all();
        $dataResultado = $data['eva_resultados'];
        foreach ($dataResultado as &$resultado) {
            $nuevoResultado = new Resultado([
                'valor' => $resultado['valor'],
                'tipo' => $resultado['tipo']
            ]);
            $respuesta = EvaPreguntaEvaRespuesta::findOrFail($resultado['eva_pregunta_eva_respuesta_id']);
            $docenteasignatura = DocenteAsignatura::findOrFail($request['idDocenteAsignatura']);

            $nuevoResultado->eva_pregunta_eva_respuesta()->associate($respuesta);
            $nuevoResultado->docente_asignatura()->associate($docenteasignatura);
            $nuevoResultado->save();
        };

        return response()->json(['resultados' => $nuevoResultado], 201);

    }
  

}