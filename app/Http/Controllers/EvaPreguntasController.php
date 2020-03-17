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
     $dataPregunta =$data['pregunta'];
     $dataTipoEvaluacion= $data['tipo_evaluaciones'];
     $evaluacion=TipoEvaluacion::finOrFail($dataTipoEvaluacion['id']);
     $response=$evaluacion->pregunta()->create($dataPregunta);
        //EvaPregunta::create($data);
       // return response()->json(['message'=>'pregunta creada correctamente'],200);
    return response()->json([$response],200);
    }

}
