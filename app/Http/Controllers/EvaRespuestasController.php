<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaRespuesta;
class EvaRespuestasController extends Controller
{
    public function getEvaRespuesta(){
        $respuesta= EvaRespuesta::all();
        return response()->json([$respuesta],200);
    }
    public function getById($id){
        $respuesta = EvaRespuesta::where('id','=',$id)->get();
        return response()->json(['respuesta'=> $respuesta],200);
    }
    public function createEvaRespuesta(Request $request){
        $data = $request->json()->all();
        EvaRespuesta::create($data);
        return response()->json(['message'=>'Respuesta creado correctamente'],200);
    }
    public function updateEvaRespuesta(Request $request){
        $data=$request->json()->all();
        $respuesta= EvaRespuesta::findOrFail($data['id']);
        $respuesta->update($data);
        return response()->json([$respuesta],200);
    }
    
}
