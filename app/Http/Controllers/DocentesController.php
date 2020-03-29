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
        return response()->json(['profesor'=>$docente],200);
    }
    public function getById(Request $request){
        $docente = Docente::where('user_id',$request->id)->get();
        return response()->json(['docente'=>$docente],200);
    }
    
    public function createDocente(Request $request){
        $data = $request->json()->all();
        $dataDocente=$data['docente'];
        $docente=Docente::create([
            'identificacion'=> $dataDocente['identificacion'],
            'apellido1'=>strtoupper(trim($dataDocente['apellido1'])),
            'apellido2'=>strtoupper(trim( $dataDocente['apellido2'])),
            'nombre1'=> strtoupper(trim($dataDocente['nombre1'])),
            'nombre2'=> strtoupper(trim( $dataDocente['nombre2'])),
            'correo_institucional'=>  $dataDocente['correo_institucional'],
            'correo_personal'=> $dataDocente['correo_personal'],
            'fecha_nacimiento' => $dataDocente['fecha_nacimiento'],
            'sexo' => strtoupper(trim($dataDocente['sexo'])),
            'estado' => strtoupper(trim($dataDocente['estado'])),
            'telefono'  => $dataDocente['telefono'],
            'tipo_identificacion' => $dataDocente['tipo_identificacion'],
        ]);
        return response()->json(['docente'=> $docente],200);
    }
    public function updateDocente(Request $request){
        $data=$request->json()->all();
        $dataDocente= $data['docente'];
        $docente= Docente::findOrFail($dataDocente['id'])->update([
            'identificacion'=> $dataDocente['identificacion'],
            'apellido1'=>strtoupper(trim($dataDocente['apellido1'])),
            'apellido2'=>strtoupper(trim( $dataDocente['apellido2'])),
            'nombre1'=> strtoupper(trim($dataDocente['nombre1'])),
            'nombre2'=> strtoupper(trim( $dataDocente['nombre2'])),
            'correo_institucional'=>  $dataDocente['correo_institucional'],
            'correo_personal'=> $dataDocente['correo_personal'],
            'fecha_nacimiento' => $dataDocente['fecha_nacimiento'],
            'telefono' => $dataDocente['telefono'],
            'sexo' => strtoupper(trim($dataDocente['sexo'])),
            'estado' => strtoupper(trim($dataDocente['estado'])),
            'tipo_identificacion' => $dataDocente['tipo_identificacion'],
        ]);
        
        return response()->json(['docente' => $docente],200);
    }

}
