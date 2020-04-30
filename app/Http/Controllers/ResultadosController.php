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
        }

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



    public function getResultadosAsignaturasId(Request $request)
    {

        $docenteAsignaturas=DocenteAsignatura::where('docente_id',$request->docente_id)
        ->where('periodo_lectivo_id',$request->periodo_lectivo_id)
        ->get();

        $total=0;
        foreach($docenteAsignaturas as $docenteAsignatura){
            $resultados= Resultado::where('docente_asignatura_id',$docenteAsignatura->id)->get();

            foreach($resultados as $resultado){
                $total +=$resultado['valor'];
            }

            $preguntas= Resultado::where('docente_asignatura_id',$docenteAsignatura->id)
                    ->distinct('eva_pregunta_eva_respuesta_id')
                    ->get();

                    $puntuacionMaxima=sizeof($preguntas)*4;
                    if($puntuacionMaxima>0){
                    $porcentaje=round(($total*100)/$puntuacionMaxima);
                   }else{
                    $porcentaje=0;
                   }

            DocenteAsignatura::findOrFail($docenteAsignatura->id)->update([
                'nota_total'=>$total,
                'porcentaje'=>$porcentaje
            ]);
            $total=0;
        }

        $da = DocenteAsignatura::where('docente_id',$request->docente_id)
        ->with('asignatura')->with('docente')->get();

        $totalAsignaturas=0;
        foreach($da as $docenteAsignatura){
            $totalAsignaturas +=$docenteAsignatura['porcentaje'];
        }

        if(sizeof($da)>0){
        $promedioAsignaturas= $totalAsignaturas/sizeof($da);
        }   else{
            $promedioAsignaturas=0;
        }
        return response()->json([
            'docenteAsignatura'=>$da,
            'promedio'=>$promedioAsignaturas,
        ],200);

    }
    public function getResultadosDocenteId(Request $request)
    {

        $resultados=Resultado::where('docente_asignatura_id',$request->docente_asignatura_id)

        //->where('periodo_lectivo_id',$request->periodo_lectivo_id)
        ->get();
        $total=0;

        foreach($resultados as $resultado){
            $total +=$resultado['valor'];
        }
        //return $total;
        $preguntas=Resultado::where('docente_asignatura_id',$resultado->docente_asignatura_id)
                            ->distinct('eva_pregunta_eva_respuesta_id')
                            ->get();

        $puntuacionMaxima=sizeof($preguntas)*4;
                if($puntuacionMaxima>0){
                $porcentaje=round(($total*100)/$puntuacionMaxima);
               }else{
                $porcentaje=0;
               }

        //return $porcentaje;
        DocenteAsignatura::where('id',$resultado->docente_asignatura_id)->update([

             'nota_total'=>$total,
             'porcentaje'=>$porcentaje
         ]);

        return response()->json(DocenteAsignatura::where('nota_total','<>',null)
        ->where('id',$resultado->docente_asignatura_id)->get(),200);
        //return response()->json(['resultados' => $resultados], 201);

    }


    public function getResultadosPromedio(Request $request)
    {

        $docenteAsignaturas=DocenteAsignatura::where('docente_id',$request->docente_id)
        ->where('periodo_lectivo_id',$request->periodo_lectivo_id)
        ->get();



        $da = DocenteAsignatura::where('docente_id',$request->docente_id)
        ->with('asignatura')->with('docente')->with('periodolectivo')->get();

        $totalAsignaturas=0;
        foreach($da as $docenteAsignatura){
            $totalAsignaturas +=$docenteAsignatura['porcentaje'];
        }

        if(sizeof($da)>0){
        $promedioAsignaturas= $totalAsignaturas/sizeof($da);
        }   else{
            $promedioAsignaturas=0;
        }
        // $total=0.0;
        if(sizeof($da)>0){
            $total= ((($totalAsignaturas/sizeof($da))*30)/100);

        }   else{
            $total=0.;
        }
        return response()->json([
            'docenteAsignatura'=>$da,
            'promedio'=>$promedioAsignaturas,
            'total30'=>$total,

        ],200);

    }
}
