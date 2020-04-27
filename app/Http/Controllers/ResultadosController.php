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
        return response()->json(['resultados'=>$resultados],200);
    }

    public function getIdDocenteAsignatura(Request $request)
    {
 //       $asignaturaDocente = DocenteAsignatura::where('docente_id',$requphp artisan serveest->id)->first();
        $asignatura = DocenteAsignatura::where('asignatura_id',$request->asignatura_id)->get();
            return response()->json(['docenteAsignatura'=>$asignatura],200);
    }

    public function createresultado(Request $request)
    {
        $data = $request->json()->all();
        $dataResultado = $data['eva_resultados'];
        foreach ($dataResultado as $resultado) {
            $nuevoResultado = new Resultado([
                'valor' => $resultado['valor'],
                'tipo' => $resultado['tipo']
            ]);
            $respuesta = EvaPreguntaEvaRespuesta::findOrFail($resultado['eva_pregunta_eva_respuesta_id']);
            $respuesta1 = Estudiante::findOrFail($resultado['estudiante_id']);
            $docenteasignatura = DocenteAsignatura::findOrFail($request['idDocenteAsignatura']);

            $nuevoResultado->eva_pregunta_eva_respuesta()->associate($respuesta);
            $nuevoResultado->estudiante()->associate($respuesta1);
            $nuevoResultado->docente_asignatura()->associate($docenteasignatura);
            $nuevoResultado->save();
        };

        return response()->json(['resultados' => $nuevoResultado], 201);

    }
    public function getResultadosAsignaturas(Request $request)
    {
        //$asignatura = DocenteAsignatura::where('id',$request->id)->get();
        $resultados= Resultado::select(
            'eva_resultados.*'
            )
        ->join('docente_asignaturas','docente_asignaturas.id','eva_resultados.docente_asignatura_id')
        ->where('docente_asignaturas.periodo_lectivo_id',4)->orderBy('docente_asignatura_id')->get();
        $docenteAsignaturaId=$resultados[0]['docente_asignatura_id'];
        $docenteAsignaturaIdTemporal=0;
        $total=0;

        foreach($resultados as $resultado){
            if($resultado['docente_asignatura_id']==$docenteAsignaturaId){
                $total +=$resultado['valor'];
                $docenteAsignaturaIdTemporal=$docenteAsignaturaId;
            }else{
                DocenteAsignatura::findOrFail($docenteAsignaturaId)->update([
                    'nota_total'=>$total
                ]);
                $docenteAsignaturaId=$resultado['docente_asignatura_id'];
                $total =$resultado['valor'];
            }
        }
        DocenteAsignatura::findOrFail($docenteAsignaturaId)->update([
            'nota_total'=>$total
        ]);

        return response()->json(DocenteAsignatura::where('nota_total','<>',null)->get(),200);

    }

}
