<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaRespuesta;
use Illuminate\Support\Facades\DB;

class EvaRespuestasController extends Controller
{
    public function getEvaRespuesta(){
        $respuesta= EvaRespuesta::all();
        return response()->json(['respuesta' => $respuesta],200);
    }
    public function getById($id){
        $respuesta = EvaRespuesta::where('id','=',$id)->get();
        return response()->json(['respuesta'=> $respuesta],200);
    }
    public function createEvaRespuesta(Request $request){
        $data = $request->json()->all();
        $dataRespuesta = $data['Respuesta'];
        $Respuesta = EvaRespuesta ::create([
            'codigo' => $dataRespuesta['codigo'],
            'orden' =>$dataRespuesta['orden'],
            'nombre' => strtoupper(trim($dataRespuesta['nombre'])),
            'valor' => $dataRespuesta['valor'],
            'tipo' => strtoupper(trim($dataRespuesta['tipo'])),
            'estado' => strtoupper(trim($dataRespuesta['estado']))
        ]);
        return response()->json(['respuesta' => $Respuesta],200);
    }

    public function updateEvaRespuesta(Request $request){
        $data=$request->json()->all();
        $dataRespuesta = $data['Respuesta'];

        $Respuesta= EvaRespuesta::findOrFail($dataRespuesta['id'])->update([
            'codigo' => $dataRespuesta['codigo'],
            'orden' =>$dataRespuesta['orden'],
            'nombre' => $dataRespuesta['nombre'],
            'valor' => $dataRespuesta['valor'],
            'tipo' => $dataRespuesta['tipo'],
            'estado' =>$dataRespuesta['estado']
        ]);
        return response()->json(['respuesta' => $Respuesta],200);
    }
    public function get (){
        $sql= 'SELECT id,codigo,orden,nombre,valor FROM eva_respuestas';
        $respuesta = DB::select($sql);
        return response()->json(['admin-respuestas' => $respuesta], 200);
    }
}
