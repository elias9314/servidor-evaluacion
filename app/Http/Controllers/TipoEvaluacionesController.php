<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEvaluacion;
class TipoEvaluacionesController extends Controller
{
    public function getTipoEvaluacion(){
        $evaluacion= TipoEvaluacion::all();
        return response()->json([$evaluacion],200);
    }
    public function getById($id){
        $evaluacion = TipoEvaluacion::where('id','=',$id)->get();
        return response()->json(['tipo evaluacion'=> $evaluacion],200);
    }
    public function createTipoEvaluacion(Request $request){
        $data = $request->json()->all();
        TipoEvaluacion::create($data);
        return response()->json(['message'=>'Tipo de evaluacion creado correctamente'],200);
    }
    public function updateTipoEvaluacion(Request $request){
        $data=$request->json()->all();
        $evaluacion= TipoEvaluacion::findOrFail($data['id']);
        $evaluacion->update($data);
        return response()->json([$evaluacion],200);
    }

}
