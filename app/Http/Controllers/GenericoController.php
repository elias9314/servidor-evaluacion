<?php

namespace App\Http\Controllers;

use App\Estudiante;
use Illuminate\Http\Request;

class GenericoController extends Controller
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

    public function getCrudes(Request $request)
    {
        $data = $request->json()->all();
        $dataDocente = $data['docente'];
        $docentes = Docente::get();
        if ($docentes) {
            return response()->json(['docente' => $docentes], 200);
        }
        return response()->json(['error' => $docentes], 500);
    }

    public function getCrud(Request $request)
    {
        $data = $request->json()->all();
        $dataDocente = $data['docente'];
        $docente = Docente::findOrFail($dataDocente['id']);

        if ($docente) {
            return response()->json(['docente' => $docente], 200);
        }
        return response()->json(['error' => $docente], 500);
    }

    public function createCrud(Request $request)
    {
        $data = $request->json()->all();
        $dataDocente = $data['docente'];

        $docente = Docente::create([
            'nombre' => $dataDocente['nombre'],
            'apellido' => $dataDocente['apellido'],
            'edad' => $dataDocente['edad'],
        ]);
        if ($docente) {
            return response()->json(['docente' => $docente], 201);
        }
        return response()->json(['error' => $docente], 500);

    }

    public function updateCrud(Request $request)
    {
        $data = $request->json()->all();
        $dataDocente = $data['docente'];

        $docente = Docente::findOrFail($dataDocente['id']);
        $docente->update([
            'nombre' => $dataDocente['nombre'],
            'apellido' => $dataDocente['apellido'],
            'edad' => $dataDocente['edad'],
        ]);
        if ($docente) {
            return response()->json(['docente' => $docente], 201);
        }
        return response()->json(['error' => $docente], 500);

    }

    public function deleteCrud(Request $request)
    {
        $docente = Docente::findOrFail($request->docente_id);
        $docente->update(['estado' => false]);
        if ($docente) {
            return response()->json(['docente' => $docente], 201);
        }
        return response()->json(['error' => $docente], 500);

    }

    public function delete2Crud(Request $request)
    {
        $docente = Docente::findOrFail($request->docente_id);
        $docente->delete();
        if ($docente) {
            return response()->json(['docente' => $docente], 201);
        }
        return response()->json(['error' => $docente], 500);

    }

    public function getEstudiantes(Request $request)
    {
        try {
            $estudiantes = Estudiante::select(
                'estudiantes.nombre1',
                'estudiantes.apellido1',
                'estudiantes.identificacion as cedula',
                'matriculas.periodo_academico_id as nivel',
                'users.role_id as rol')
                ->join('matriculas', 'estudiantes.id', '=', 'matriculas.estudiante_id')
                ->join('users', 'estudiantes.user_id', '=', 'users.id')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->get();
        } catch (\ErrorException $e) {
            return response()->json(['errorInfo' => ['001']], 404);
        }
        return response()->json([
            'estudiantes' => $estudiantes
        ], 200);
    }
}
