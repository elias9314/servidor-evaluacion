<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Estudiante;
use App\InformacionEstudiante;
use App\Instituto;
use App\Matricula;
use App\PeriodoLectivo;
use App\Ubicacion;
use App\User;

use Illuminate\Http\Request;
use App\Docente;
use Illuminate\Support\Facades\DB;

class DocentesController extends Controller
{
   
    public function getDocente(){
        $docente= Docente::all();
        return response()->json($docente,200);
    }
    public function getById($id){
        $docente = Docente::where('id','=',$id)->get();
        return response()->json([$docente],200);
    }
    public function createDocente(Request $request){
        $data = $request->json()->all();
        Docente::create($data);
        return response()->json(['message'=>'Docente creado correctamente'],200);
    }
    public function updateDocente(Request $request){
        $data=$request->json()->all();
        $docente= Docente::findOrFail($data['id']);
        $docente->update($data);
        return response()->json([$docente],200);
    }

}
