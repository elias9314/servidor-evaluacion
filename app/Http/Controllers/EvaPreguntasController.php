<?php

namespace App\Http\Controllers;

use App\TipoEvaluacion;
use Illuminate\Http\Request;
use App\EvaPregunta;

class EvaPreguntasController extends Controller
{
    public function getPreguntas(){
        $preguntas=EvaPregunta::with('tipo_evaluacion')->orderBy('orden')->get();
        return response()->json(['preguntas'=>$preguntas],200);
    }

    public function getById($id){
        $pregunta=EvaPregunta::with('tipo_evaluacion')->where('id','=',$id)->orderBy('id')->get();
        return response()->json(['preguntas'=> $pregunta],200);
    }

    public function createPregunta(Request $request){
         $data=$request->json()->all();
        $dataPreguntas = $data['eva_preguntas'];
        $dataTipoEvaluaciones = $data['eva_preguntas']['tipo_evaluacion'];
        $tipoevaluacion = TipoEvaluacion::findOrFail($dataTipoEvaluaciones['id']);
        $preguntas = $tipoevaluacion->pregunta()->create([
            'codigo'=>$dataPreguntas['codigo'],
            'orden'=>$dataPreguntas['orden'],
            'nombre'=>$dataPreguntas['nombre'],
            'tipo'=>$dataPreguntas['tipo'],
            'estado'=>$dataPreguntas['estado'],
        ]);
        return response()->json(['eva_pregunta'=> $preguntas],200);
        }


    public function updatePregunta(Request $request){
            $data=$request->json()->all();
            $dataPregunta =$data['eva_pregunta'];
            $dataTipoEvaluacion= $data['eva_pregunta']['tipo_evaluacion'];
            $evaluacion=TipoEvaluacion::find($dataTipoEvaluacion['id']);
            $pregunta=EvaPregunta::find($dataPregunta['id']);
            $response = $pregunta->update([
                'codigo'=>$dataPregunta['codigo'],
                'orden'=>$dataPregunta['orden'],
                'nombre'=>$dataPregunta['nombre'],
                'tipo'=>$dataPregunta['tipo'],
                'estado'=>$dataPregunta['estado']
            ]);
            $pregunta->tipo_evaluacion()->associate($evaluacion);
            $pregunta->save();
            return response()->json(['eva_pregunta' => $response],200);
        }

}
