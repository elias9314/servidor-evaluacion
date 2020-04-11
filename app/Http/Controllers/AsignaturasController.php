<?php

namespace App\Http\Controllers;

use App\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AsignaturasController extends Controller
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

    public function get()
    {
        $asignaturas = Asignatura::where('estado', 'ACTIVO')->with('periodo_academico')->get();
        return response()->json(['asignaturas' => $asignaturas], 200);
    }

    public function getOne(Request $request)
    {
        //$data = $request->json()->all();

        $sql = 'SELECT estudiantes.*
                FROM
                  matriculas inner join informacion_estudiantes on matriculas.id = informacion_estudiantes.matricula_id
	              inner join estudiantes on matriculas.estudiante_id = estudiantes.id
	            WHERE matriculas.periodo_lectivo_id = 1 and matriculas.estudiante_id =1';
        $estudiante = DB::select($sql);

        $sql = 'SELECT informacion_estudiantes.*
                FROM
                  matriculas inner join informacion_estudiantes on matriculas.id = informacion_estudiantes.matricula_id
	              inner join estudiantes on matriculas.estudiante_id = estudiantes.id
	            WHERE matriculas.periodo_lectivo_id = 1 and matriculas.estudiante_id =1';
        $informacionEstudiante = DB::select($sql);
        return response()->json([
            'estudiante' => $estudiante[0],
            'informacion_estudiante' => $informacionEstudiante[0]
        ]);
    }
    public function getDatosbyIDAsignatura(Request $request)
    {
        try {
            $asignatura = Asignatura::where('id', [$request->id])->first();
            // $periodoLectivoActual = PeriodoLectivo::where($request->periodo_lectivo_id)->first();
            // $matricula = Matricula::select(
            //     'detalle_matriculas.id',
            //     'asignaturas.id as idAsignatura',
            //     'docentes.nombre1',
            //     'docentes.apellido1',
            //     'asignaturas.codigo',
            //     'asignaturas.nombre',
            //     'detalle_matriculas.paralelo',
            //     'detalle_matriculas.jornada',
            //     'detalle_matriculas.estado_evaluacion'
            // )
            // ->join('detalle_matriculas', 'detalle_matriculas.matricula_id', '=', 'matriculas.id')
            // ->join('asignaturas', 'asignaturas.id', '=', 'detalle_matriculas.asignatura_id')
            // ->join('docente_asignaturas', 'asignaturas.id', '=', 'docente_asignaturas.asignatura_id')
            // ->join('docentes', 'docentes.id', '=', 'docente_asignaturas.docente_id')
            // ->where('matriculas.estudiante_id', $estudiante->id)
            // ->where('matriculas.periodo_lectivo_id', $periodoLectivoActual->id)
                // ->first();
        } catch (\ErrorException $e) {
            return response()->json(['errorInfo' => ['001']], 404);
        }
        return response()->json([
            'asignatura' => $asignatura,
        ], 200);
    }

    public function update(Request $request)
    {
        $data = $request->json()->all();
        $dataEstudiante = $data['estudiante'];
        $dataInformacionEstudiante = $data['estudiante'];
        $parameters = [
            $dataEstudiante['pais_nacionalidad_id'],
            $dataEstudiante['pais_residencia_id'],
            $dataEstudiante['identificacion'],
            $dataEstudiante['nombre1'],
            $dataEstudiante['nombre2'],
            $dataEstudiante['apellido1'],
            $dataEstudiante['apellido2'],
            $dataEstudiante['fecha_nacimiento'],
            $dataEstudiante['correo_personal'],
            $dataEstudiante['correo_institucional'],
            $dataEstudiante['sexo'],
            $dataEstudiante['etnia'],
            $dataEstudiante['tipo_sangre'],
            $dataEstudiante['tipo_documento'],
            $dataEstudiante['tipo_colegio'],
        ];
        $sql = 'SELECT estudiantes.*
                FROM
                  matriculas inner join informacion_estudiantes on matriculas.id = informacion_estudiantes.matricula_id
	              inner join estudiantes on matriculas.estudiante_id = estudiantes.id
	            WHERE matriculas.periodo_lectivo_id = 1 and matriculas.estudiante_id =1';
        $estudiante = DB::select($sql, null);

        $sql = 'SELECT informacion_estudiantes.*
                FROM
                  matriculas inner join informacion_estudiantes on matriculas.id = informacion_estudiantes.matricula_id
	              inner join estudiantes on matriculas.estudiante_id = estudiantes.id
	            WHERE matriculas.periodo_lectivo_id = 1 and matriculas.estudiante_id =1';
        $informacionEstudiante = DB::select($sql, null);
        return response()->json([
            'estudiante' => $estudiante,
            'informacion_estudiante' => $informacionEstudiante
        ]);
    }
}
