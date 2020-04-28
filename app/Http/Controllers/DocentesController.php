<?php

namespace App\Http\Controllers;

use App\Carrera;
use App\Estudiante;
use App\DocenteAsignatura;
use App\InformacionEstudiante;
use App\Instituto;
use App\Matricula;
use App\PeriodoLectivo;
use App\Ubicacion;
use App\User;

use Illuminate\Http\Request;
use App\Docente;

use Illuminate\Support\Facades\Storage;

class DocentesController extends Controller
{

    public function getDocente(){
        $docente= Docente::with('user','docenteasignatura')->orderBy('id')->get();
        return response()->json(['profesor'=>$docente],200);
    }
    public function getById(Request $request){
        $docente = Docente::where('user_id',$request->id)->with('user')->with('docenteasignatura')->get();
        return response()->json(['docente'=>$docente],200);
    }

    public function createDocente(Request $request)
    {
        $ruta='';
        if ($request->hasFile('imagen')){
        $file = $request->file('imagen');
        $name = time().$file->getClientOriginalName();
         $ruta = $file->move(public_path().'/fotos/', $name);

    }
        $dataDocente=$request;
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
            'imagen'=>$ruta
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
            //'imagen'=>$dataDocente['imagen']
        ]);

        return response()->json(['docente' => $docente],200);

   }

   public function getDocentesAsignaturas(Request $request){
       $docentesAsignaturas = DocenteAsignatura::where('periodo_lectivo_id',$request->periodo_lectivo_id)
       ->with('docente')
       ->with('asignatura')
       ->get();
       return response()->json(['docentesAsignaturas' => $docentesAsignaturas],200);
   }
}
