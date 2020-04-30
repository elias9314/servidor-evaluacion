<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/detalle_matriculas', 'DetalleMatriculasController@create');
Route::put('/detalle_matriculas/cupo', 'DetalleMatriculasController@updateCupo');
Route::put('/detalle_matriculas/matricula', 'DetalleMatriculasController@updateMatricula');
Route::get('/detalle_matriculas', 'DetalleMatriculasController@get');
Route::get('/detalle_matriculas/count', 'DetalleMatriculasController@getCountDetalleCuposCarrera');

Route::get('/asignaturas', 'AsignaturasController@get');
Route::get('/asignaturas/{id}', 'AsignaturasController@getOne');
Route::get('/asignaturaEstudiante/{id}', 'AsignaturasController@getDatosbyIDAsignatura');

Route::get('/periodo_lectivos', 'PeriodoLectivosController@get');
Route::delete('/periodo_lectivos', 'PeriodoLectivosController@delete');
Route::get('/periodo_lectivos/historicos', 'PeriodoLectivosController@getHistoricos');
Route::get('/periodo_lectivos/actual', 'PeriodoLectivosController@getActual');
Route::get('/periodo_lectivos/{id}', 'PeriodoLectivosController@getOne');
Route::post('/periodo_lectivos', 'PeriodoLectivosController@create');
Route::put('/periodo_lectivos', 'PeriodoLectivosController@update');
Route::put('/periodo_lectivos/cerrar', 'PeriodoLectivosController@close');
Route::put('/periodo_lectivos/activar', 'PeriodoLectivosController@activate');

Route::get('/tipo_matriculas', 'TipoMatriculasController@get');
Route::get('/tipo_matriculas/{id}', 'TipoMatriculasController@getOne');

Route::get('/matriculas/cupo', 'MatriculasController@getCupo');
Route::get('/matriculas/aprobado', 'MatriculasController@getAprobado');
Route::delete('/matriculas/cupo', 'MatriculasController@deleteCupo');
Route::delete('/matriculas/matricula', 'MatriculasController@deleteMatricula');
Route::get('/matriculas/validate_cupo', 'MatriculasController@validateCupo');
Route::get('/matriculas/validate_cupo_asignatura', 'MatriculasController@validateCupoAsignatura');
Route::get('/matriculas/validate_cupos_carrera', 'MatriculasController@validateCuposCarrera');
Route::get('/matriculas/validate_cupos_periodo_academico', 'MatriculasController@validateCuposPeriodoAcademico');
Route::delete('/matriculas/delete_cupos_carrera', 'MatriculasController@deleteCuposCarrera');
Route::delete('/matriculas/delete_cupos_periodo_academico', 'MatriculasController@deleteCuposPeriodo');
Route::get('/matriculas/certificado_matricula', 'MatriculasController@getCertificadoMatricula');
Route::get('/matriculas/solicitud_matricula', 'MatriculasController@getSolicitudMatricula');
Route::get('/matriculas/carreras', 'MatriculasController@getMatriculasCarreras');
Route::get('/matriculas/periodo_academicos', 'MatriculasController@getMatriculasPeriodoAcademicos');
Route::get('/matriculas/cupos', 'MatriculasController@getCupos');
Route::get('/matriculas/cupos/estado', 'MatriculasController@getCuposPorEstado');
Route::get('/matriculas/aprobados', 'MatriculasController@getAprobados');
Route::get('/matriculas/en_proceso', 'MatriculasController@getCuposEnProceso');
Route::get('/matriculas/asignaturas', 'MatriculasController@getAsignaturasMalla');
Route::put('/matriculas/cupo', 'MatriculasController@updateCupo');
Route::put('/matriculas/matricula', 'MatriculasController@updateMatricula');
Route::get('/matriculas/count', 'MatriculasController@getCountMatriculas');
Route::delete('/matriculas/delete_detalle_cupo', 'MatriculasController@deleteDetalleCupo');
Route::delete('/matriculas/delete_detalle_matricula', 'MatriculasController@deleteDetalleMatricula');
Route::put('/matriculas/fecha_formulario', 'MatriculasController@updateFechaFormulario');
Route::put('/matriculas/fecha_solicitud', 'MatriculasController@updateFechaSolicitud');
Route::delete('/matriculas/desert', 'MatriculasController@desertMatricula');
Route::delete('/matriculas/unregister', 'MatriculasController@unregisterMatricula');
Route::get('/matriculas/estudiantes', 'MatriculasController@getEstudiante');
Route::get('/matriculas/estudiantes/formulario', 'MatriculasController@getFormulario');
Route::get('/matriculas/estudiantes/solicitud_matricula', 'MatriculasController@getSolicitudMatricula');

Route::get('/catalogos/paises', 'CatalogosController@getPaises');
Route::get('/catalogos/provincias', 'CatalogosController@getProvincias');
Route::get('/catalogos/cantones', 'CatalogosController@getCantones');
Route::get('/catalogos/carreras', 'CatalogosController@getCarreras');
Route::get('/catalogos/periodo_academicos', 'CatalogosController@getPeriodoAcademicos');
Route::get('/exports/cupos_carrera', 'ExcelController@exportCuposCarrera');
Route::get('/exports/cupos_periodo_academico', 'ExcelController@exportCuposPeriodoAcademico');
Route::get('/exports/matriz_sniese', 'ExcelController@exportMatrizSnieseCarrera');
Route::get('/exports/cupos_malla', 'ExcelController@exportCuposMalla');
Route::get('/exports/cupos_malla_periodo_academico', 'ExcelController@exportCuposMallaPeriodoAcademico');
Route::get('/exports/listas/periodo', 'ExcelController@exportListasPeriodo');

Route::post('/imports/cupos', 'ExcelController@importCupos');
Route::post('/imports/estudiantes', 'ExcelController@importEstudiantes');
Route::post('/imports/matriculas', 'ExcelController@importMatriculas');
Route::post('/imports/paralelos', 'ExcelController@importParalelos');
Route::post('/imports/notas', 'ExcelController@importNotas');

Route::get('/certificado-matricula/{matricula_id}', 'MatriculasController@getCertificadoMatriculaPublic');

Route::get('/exports/errores_cupos', 'ExcelController@exportErroresCupos');
Route::get('/exports/numerico_matriculas', 'ExcelController@exportNumericoMatriculas');

Route::get('/email', 'PruebasController@email');
Route::post('/emails/cupos', 'EmailsController@sendCupos');
Route::post('/emails/upload_cupos', 'EmailsController@sendUploadCupos');
Route::post('/emails/detalle_cupos', 'EmailsController@sendDetalleCupos');


Route::get('/paralelos', 'ExcelController@changeParalelo');

Route::get('/eva_preguntas_eva_respuestas','EstudiantesController@getPreguntasRespuestas');
Route::get('/estudiantes/docente_asignatura', 'EstudiantesController@getDocenteAsignatura');
Route::get('/estudiantes/asignaturas_actual', 'EstudiantesController@getAsignaturasActual');
Route::get('/estudiantes/eva_preguntas', 'EstudiantesController@getEvaPreguntas');
Route::get('/estudiantes/historicos', 'EstudiantesController@getHistoricos');
Route::get('/estudiantes/en_proceso', 'EstudiantesController@getEnProceso');
Route::get('/estudiantes/{id}', 'EstudiantesController@getOne');
Route::get('/docentes/{id}', 'EstudiantesController@getDatosbyID');
Route::get('/estudianteAsignaturas/{id}', 'EstudiantesController@getDatosbyIDAsignatura');
Route::get('/cupos/estudiantes', 'EstudiantesController@getInformacionEstudianteCupo');
Route::put('/cupos/estudiantes', 'EstudiantesController@updateInformacionEstudianteCupo');
Route::get('/estudiantes/formulario/{id}', 'EstudiantesController@getFormulario');
Route::put('/estudiantes/update_perfil', 'EstudiantesController@updatePerfil');
Route::get('/estudiantes/solicitud_matricula', 'EstudiantesController@getSolicitudMatricula');
// Route::get('/docentesAsignaturas','EstudiantesController@getDocenteAsig');



Route::put('/users/reset_password', 'UsersController@resetPassword');
Route::get('/usuarios', 'UsersController@get');
Route::get('/usuarios/login', 'UsersController@getLogin');
Route::get('/usuarios/filter', 'UsersController@filter');
//Route::get('/usuarios', 'UsersController@getUsuarioDocentes');
Route::post('/usuarios', 'UsersController@create');
Route::put('/usuarios', 'UsersController@update');

Route::get('/roles', 'UsersController@getRoles');

Route::get('/carreras', 'CarrerasController@getCarreras');


Route::post('/login', 'UsersController@login');

Route::post('/matriculas/open_periodo_lectivo', 'MatriculasController@openPeriodoLectivo');

Route::get('/prueba', 'PruebasController@a')->middleware('auth:api');


Route::get('/v2/estudiantes', 'GenericoController@getEstudiantes');
Route::post('/v2/prueba_crud', 'GenericoController@createCRUD');

///////Rutas para tipo de evaluacion////////////////
Route::get('/tipo_evaluaciones','TipoEvaluacionesController@getTipoEvaluacion');
Route::get('/tipo_evaluaciones/{id}','TipoEvaluacionesController@getById');
Route::post('/tipo_evaluacion','TipoEvaluacionesController@createTipoEvaluacion');
Route::put('/tipo_evaluaciones','TipoEvaluacionesController@updateTipoEvaluacion');
///////Rutas para respuestas ///////////////
Route::get('/eva_respuestas','EvaRespuestasController@getEvaRespuesta');
Route::get('/eva_respuestas/{id}','EvaRespuestasController@getById');
Route::post('/eva_respuestas','EvaRespuestasController@createEvaRespuesta');
Route::put('/eva_respuestas','EvaRespuestasController@updateEvaRespuesta');

///////////Rutas evaluacion preguntas///////////////////////
Route::get('/evaluacion_preguntas','EvaPreguntasController@getPreguntas');
Route::get('/evaluacion_preguntas/{id}','EvaPreguntasController@getById');
Route::post('/evaluacion_pregunta','EvaPreguntasController@createPregunta');
Route::put('/evaluacion_preguntas','EvaPreguntasController@updatePregunta');

Route::get('/comparar_claves','PruebasController@compararClaves');
Route::get('/generar_clave','PruebasController@generarClave');
///////////Docentes///////////////////////

Route:: get('/docentes','DocentesController@getDocente');
Route::get('/docentes/{id}','DocentesController@getById');
Route::get('/docentes/filter','DocentesController@filter');
Route::post('/docente','DocentesController@createDocente');
Route::put('/docentes','DocentesController@updateDocente');
Route::get('/evaluado','DocentesController@putEvaluado');


/////////Admin Estudiantes y resultados//////////////
Route::get('/admin-estudiantes','EstudiantesController@adminGet');
Route::get('/admin-respuestas','EvaRespuestasController@get');

///////////////////////////////////////////////////
Route::get('/respuestas','ResultadosController@getresultados');
Route::get('/resultados','EvaPreguntaEvaRespuestaController@getPreguntaRespuesta');
Route::post('/resultado','ResultadosController@createresultado');
Route::get('/asignatura_docente','ResultadosController@getIdDocenteAsignatura');
Route::get('/preguntasrespuestas','EvaPreguntaEvaRespuestaController@getEvaPreguntasEvaRespuestas');


Route::get('/detallematricula','EstudiantesController@getDetalleM');
Route::put('/estado_evaluacion','EstudiantesController@updateEstadoEvaluacion');
Route::get('/resultados_docente','ResultadosController@getResultadosAsignaturas');


Route::get('/docente_resultados','ResultadosController@getResultadosAsignaturasId');


Route::get('/docente_asignaturas','DocentesController@getDocentesAsignaturas');

Route::get('/docente_asignatura','DocentesController@getDocenteAsig');
Route::get('/docenteId','ResultadosController@getResultadosDocenteId');
Route::get('/promedio','ResultadosController@getResultadosPromedio');

Route::post('/pregunta_respuesta','EvaPreguntaEvaRespuestaController@createPregunta');


