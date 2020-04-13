<?php

namespace App\Http\Controllers;

use App\DocenteAsignatura;
use App\Estudiante;
use App\EvaPreguntaEvaRespuesta;
use App\EvaRespuesta;
use App\Matricula;
use App\Resultado;
use App\PeriodoLectivo;

use Illuminate\Http\Request;

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
    public function getDocenteEstudiante(Request $request)
    {
        try {
    //         SELECT   docenteasignatura.id,  docente.apellido1,  docenteasignatura.asignatura_id, asignatura.nombre
	// FROM public.docente_asignaturas docenteasignatura
	// inner join  docentes docente on docenteasignatura.docente_id= docente.id
	// inner join asignaturas asignatura on docenteasignatura.asignatura_id= asignatura.id
	// where  docenteasignatura.docente_id=150 and  docenteasignatura.asignatura_id= 515;
            $estudiante = Estudiante::where('user_id', $request->user_id)->first();
            $periodoLectivoActual = PeriodoLectivo::findOrFail($request->periodo_lectivo_id);
            $asignaturasMatricula = Matricula::select(
                'asignaturas.id as idAsignatura',
                'docente_asignaturas.docente_id',
                'docentes.nombre1',
                'docentes.apellido1',
                'docente_asignaturas.id as docente_asignatura_id',
                'asignaturas.nombre',
                'detalle_matriculas.estado_evaluacion',
                'matriculas.estudiante_id'
            )
                ->join('detalle_matriculas', 'detalle_matriculas.matricula_id', '=', 'matriculas.id')
                ->join('asignaturas', 'asignaturas.id', '=', 'detalle_matriculas.asignatura_id')
                ->join('docente_asignaturas', 'asignaturas.id', '=', 'docente_asignaturas.asignatura_id')
                ->join('docentes', 'docentes.id', '=', 'docente_asignaturas.docente_id')
                ->where('matriculas.estudiante_id', $estudiante->id)
                ->where('matriculas.periodo_lectivo_id', $periodoLectivoActual->id)
                ->get();
                // foreach($asignaturasMatricula as $lol){
                //     $lol.push($lol.'detalle_matriculas.id');
                //     print ($lol);
                // }

        } catch (\ErrorException $e) {
            return response()->json(['errorInfo' => ['001']], 404);
        }
        return response()->json([
            'docente_estudiante' => $asignaturasMatricula,
            // 'docente'=>$docente
        ], 200);
    }
    public function getIdDocenteAsignatura(Request $request)
    {
        $docente = DocenteAsignatura::where('docente_id',$request->docente_id)->get();
        return response()->json(['docenteAsignatura'=>$docente],200);
        // try {
        //     $asignatura = DocenteAsignatura::where('docente_id',$request->id)->first;
        //     //$docente = Docente::where('user_id', $request->id)->first();
        //     $periodoLectivoActual = PeriodoLectivo::where($request->periodo_lectivo_id)->first();
           
        //     // ->where('docente_id.estudiante_id', $estudiante->id)
        //     // ->where('matriculas.periodo_lectivo_id', $periodoLectivoActual->id)
        //         // ->first();
        // } catch (\ErrorException $e) {
        //     return response()->json(['errorInfo' => ['001']], 404);
        // }
        // return response()->json([
        //     'docente_asignatura' => $asignatura,
        // ], 200);
    }

    public function getDatosbyID(Request $request)
    {
        try {
            $docente = Docente::where('user_id', $request->id)->first();
            $periodoLectivoActual = PeriodoLectivo::where($request->periodo_lectivo_id)->first();
            // $matricula = Matricula::select(
            //     'detalle_matriculas.id',
            //     'asignaturas.id as idAsignatura',
            //     'docentes.nombre1',
            //     'docentes.apellido1',
            //     'asignaturas.codigo',
            //     'asignaturas.nombre',
            //     'detalle_matriculas.paralelo',
            //     'detalle_matriculas.jornada',
            //     'detalle_matriculas.estado_evaluacion'
            // )
            // ->join('detalle_matriculas', 'detalle_matriculas.matricula_id', '=', 'matriculas.id')
            // ->join('asignaturas', 'asignaturas.id', '=', 'detalle_matriculas.asignatura_id')
            // ->join('docente_asignaturas', 'asignaturas.id', '=', 'docente_asignaturas.asignatura_id')
            // ->join('docentes', 'docentes.id', '=', 'docente_asignaturas.docente_id')
            // ->where('matriculas.estudiante_id', $estudiante->id)
            // ->where('matriculas.periodo_lectivo_id', $periodoLectivoActual->id)
                // ->first();
        } catch (\ErrorException $e) {
            return response()->json(['errorInfo' => ['001']], 404);
        }
        return response()->json([
            'docente' => $docente,
        ], 200);
    }

}
