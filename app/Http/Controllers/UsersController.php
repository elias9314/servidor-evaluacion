<?php

namespace App\Http\Controllers;

use App\Role;
use App\Docente;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getLogin(Request $request)
    {
        $user = User::where('email', strtolower($request->email))
            ->with('role')
            ->first();
        return response()->json(['usuario' => $user], 200);
    }

    public function get(Request $request)
    {
        $usuarios = Docente::with('user')
            ->orderBy('apellido1')
            ->paginate($request->records_per_page);
        return response()->json(['pagination' => [
            'total' => $usuarios->total(),
            'current_page' => $usuarios->currentPage(),
            'per_page' => $usuarios->perPage(),
            'last_page' => $usuarios->lastPage(),
            'from' => $usuarios->firstItem(),
            'to' => $usuarios->lastItem()], 'usuarios' => $usuarios], 200);
    }
    public function getUsuarioDocentes(){
        $docente= User::all();
        return response()->json(['usuario'=>$docente],200);
    }

    public function filter(Request $request)
    {
        $usuarios = Docente::orWhere('identificacion', 'like', '%' .$request->buscador . '%')

            ->orWhere('correo_institucional', 'like', '%' .  strtolower(trim($request->buscador)) . '%')
            ->orWhere('nombre1', 'like', '%' . strtoupper(trim($request->buscador)) . '%')
            ->orWhere('apellido1', 'like', '%' . strtoupper(trim($request->buscador)). '%')
            ->with('user')

                    ->orWhere('correo_institucional', 'like', '%' .  strtolower(trim($request->buscador)) . '%')
                    ->orWhere('nombre1', 'like', '%' . strtoupper(trim($request->buscador)) . '%')
                    ->orWhere('apellido1', 'like', '%' . strtoupper(trim($request->buscador)). '%')
                    ->with('user')

            ->orderBy('apellido1')
            ->get();
        return response()->json(['usuarios' => $usuarios], 200);
    }

    public function create(Request $request)
    {
        $data = $request->json()->all();
        $dataUsuario = $data['usuario'];
        $dataDocente = $data['docente'];
        $rol = Role::find(7);
        // $dataCarreras = $data['usuario']['carreras'];
        //$dataRol = $data['usuario']['role'];
        $usuario = User::where('email', $dataUsuario['email'])->orWhere('user_name',$dataUsuario['user_name'])->first();
//        $rol = Role::findOrFail($dataRol['id']);

        if (!$usuario) {
            DB::beginTransaction();
            $usuario = $rol->users()->create([
                'name' => strtoupper(trim($dataUsuario['name'])),
                'user_name' => strtoupper(trim($dataUsuario['user_name'])),
                'email' => strtolower(trim($dataUsuario['email'])),
                'password' => Hash::make(trim($dataUsuario['user_name'])),
            ]);
            $usuario->docente()->create([
                'tipo_identificacion'=>$dataDocente['tipo_identificacion'],
                'identificacion'=> $dataDocente['identificacion'],
                'nombre1'=> strtoupper(trim($dataDocente['nombre1'])),
                //'nombre2'=> strtoupper(trim($dataDocente['nombre2'])),
                'apellido1'=> strtoupper(trim($dataDocente['apellido1'])),
                //'apellido2'=> strtoupper(trim($dataDocente['apellido2'])),
                'correo_institucional' =>$dataDocente['correo_institucional'],
                //'correo_personal' => $dataDocente['correo_personal'],
                //'fecha_nacimiento' => $dataDocente['fecha_nacimiento'],
                //'sexo' => strtoupper(trim($dataDocente['sexo'])),
                'estado' => strtoupper(trim($dataDocente['estado'])),

            ]);
            // for ($i = 0; $i < sizeof($dataCarreras); $i++) {
            //     $usuario->carreras()->attach($dataCarreras[$i]['id']);
            // }
            DB::commit();
        } else {
            return response()->json(['errorInfo' => ['23505']], 400);
        }
        return response()->json(['usuario' => $usuario], 201);
    }

    public function update(Request $request)
    {
        $data = $request->json()->all();
        $dataUsuario = $data['usuario'];
        $dataDocente= $data['docente'];

        //        $dataCarreras = $data['usuario']['carreras'];
        //      $dataRol = $data['usuario']['role'];
        $usuario = User::findOrFail($dataUsuario['id']);
        // $rol = Role::findOrFail($dataRol['id']);

  //        $dataCarreras = $data['usuario']['carreras'];
  //      $dataRol = $data['usuario']['role'];
        $usuario = User::findOrFail($dataUsuario['id']);
       // $rol = Role::findOrFail($dataRol['id']);


        if ($usuario) {
            DB::beginTransaction();
            //$usuario->carreras()->detach();
            // for ($i = 0; $i < sizeof($dataCarreras); $i++) {
            //     $usuario->carreras()->attach($dataCarreras[$i]['id']);
            //}
            $usuario->update([
                'name' =>  strtoupper(trim($dataUsuario['name'])),
                'user_name' => $dataUsuario['user_name'],
                'email' => $dataUsuario['email'],
                'estado' => $dataUsuario['estado'],
            ]);
            $usuario->docente()->update([
                'tipo_identificacion'=>$dataDocente['tipo_identificacion'],
                'identificacion'=> $dataDocente['identificacion'],
                'nombre1'=> strtoupper(trim($dataDocente['nombre1'])),
                //'nombre2'=> strtoupper(trim($dataDocente['nombre2'])),
                'apellido1'=> strtoupper(trim($dataDocente['apellido1'])),
                //'apellido2'=> strtoupper(trim($dataDocente['apellido2'])),
                'correo_institucional' =>$dataDocente['correo_institucional'],
                //'correo_personal' => $dataDocente['correo_personal'],
                //'fecha_nacimiento' => $dataDocente['fecha_nacimiento'],
                //'sexo' => strtoupper(trim($dataDocente['sexo'])),
                'estado' => strtoupper(trim($dataDocente['estado'])),

            ]);

            //$usuario->role()->associate($rol);
            $usuario->save();
            DB::commit();
        } else {
            return response()->json(['errorInfo' => ['23505']], 400);
        }
        return response()->json(['usuario' => '$usuario'], 201);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->json()->all();
        $dataUser = $data['user'];
        $user = User::findOrFail($dataUser['id']);
        $user->update([
            'password' => Hash::make($dataUser['password']),
        ]);
        return $user;
    }

    public function getRoles(Request $request)
    {
        $roles = Role::where('rol', '<>', '2')->get();
        return response()->json(['roles' => $roles], 200);
    }

}