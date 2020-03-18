<?php

namespace App\Http\Controllers;

use App\TipoEvaluacion;
use Illuminate\Http\Request;
use App\EvaPregunta;
class EvaPreguntasController extends Controller
{
    public function getPreguntas(){
        $preguntas=EvaPregunta::all();
        return response()->json([$preguntas],200);
    }

    public function getById($id){
        $pregunta=EvaPregunta::where('id','=',$id)->get();
        return response()->json([$pregunta],200);
    }

    public function createPregunta(Request $request){
        $data=$request->json()->all();

     $dataPregunta=$data;
     $pregunta=EvaPregunta::create([
         'tipo_evaluacion_id'=>$dataPregunta['tipo_evaluacion_id'],
         'codigo'=>$dataPregunta['codigo'],
         'orden'=>$dataPregunta['orden'],
         'nombre'=>$dataPregunta['nombre'],
         'tipo'=>$dataPregunta['tipo'],
         'estado'=>$dataPregunta['estado'],
     ]);
     return response()->json([$pregunta],200);
        //$data=$request->json()->all();
     //$dataPregunta =$data['eva_preguntas'];
     //$dataTipoEvaluacion= $data['tipo_evaluaciones'];
     //$evaluacion=TipoEvaluacion::find($dataTipoEvaluacion['id']);
     //$response=$evaluacion->pregunta()->create($dataPregunta);
     //EvaPregunta::create($data);
       // return response()->json(['message'=>'pregunta creada correctamente'],200);
    //return response()->json([$response],200);
    }


}
