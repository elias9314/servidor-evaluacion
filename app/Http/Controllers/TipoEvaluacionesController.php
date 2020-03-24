<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoEvaluacion;
class TipoEvaluacionesController extends Controller
{
    public function getTipoEvaluacion(){
        $evaluacion= TipoEvaluacion::all();
        return response()->json(['tipo'=>$evaluacion],200);
    }
    public function getById($id){
        $evaluacion = TipoEvaluacion::where('id','=',$id)->get();
        return response()->json(['tipo_evaluacion'=> $evaluacion],200);
    }
    public function createTipoEvaluacion(Request $request){
      //  $data = $request->json()->all();
       // TipoEvaluacion::create($data);
        //return response()->json(['tipo'=>$data],200);
        $data = $request->json()->all();
        $dataTipoEvaluacion=$data['tipo_evaluacion'];
        $tipoEvaluacion=TipoEvaluacion::create([
            'nombre' => $dataTipoEvaluacion['nombre'],
            'evaluacion' => $dataTipoEvaluacion['evaluacion'],
            'estado' => $dataTipoEvaluacion['estado'],
        ]);
        return response()->json(['tipo_evaluacion' => $tipoEvaluacion], 200);
    }
    public function updateTipoEvaluacion(Request $request){
        $data=$request->json()->all();
        $dataTipoEvaluacion=$data['tipo_evaluacion'];
        $evaluacion= TipoEvaluacion::findOrFail($dataTipoEvaluacion['id'])->update([
            'nombre'=>$dataTipoEvaluacion['nombre'],
            'evaluacion'=>$dataTipoEvaluacion['evaluacion'],
            'estado'=>$dataTipoEvaluacion['estado']
        ]);
        return response()->json(['tipo_evaluacion' => $evaluacion], 200);

    }

}
