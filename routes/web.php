<?php

use App\Http\Controllers\CartaConfidencialidadController;
use App\Http\Controllers\CiclosController;
use App\Http\Controllers\EvaluacionesController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::resource('usuarios', User::class)
    ->names('usuarios')
    ->middleware('auth', 'admin');

Route::resource('ciclos', CiclosController::class)
    ->names('ciclos')
    ->middleware('admin');

Route::resource('evaluaciones', EvaluacionesController::class)
    ->names('evaluaciones')
    ->middleware('auth', 'admin');

Route::resource('proyectos', ProyectosController::class)
    ->names('proyectos')
    ->middleware('auth');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/datos-generales', [User::class, 'datos_generales'])->name('datos_generales');

Route::get('/usuario/{id}/edit', [User::class, 'role'])
    ->name('usuario.edit')
    ->middleware('auth', 'admin');

Route::post('/usuario-update/{id}', [User::class, 'usuario_update'])
    ->name('usuario.update')
    ->middleware('auth', 'admin');

Route::get('/ciclo/{id}/cerrar', [CiclosController::class, 'cerrar'])
    ->name('cerrar-ciclo')
    ->middleware('auth', 'admin');

Route::get('/proyectos-evaluador/{evalaudor}/{ciclo?}', [EvaluacionesController::class, 'evaluaciones_index'])
    ->name('evaluador-proyectos')
    ->middleware('auth');

Route::get('/imprimirProyecto/{id}', [ProyectosController::class, 'imprimirProyecto'])
    ->name('imprimirProyecto')
    ->middleware('auth');

Route::get('/proyecto-definitivo/{id}', [ProyectosController::class, 'proyecto_definitivo'])
    ->name('proyectos.definitivo')
    ->middleware('auth');

Route::get('/proyecto-eliminar/{id}', [ProyectosController::class, 'delete'])
    ->name('proyectos.delete')
    ->middleware('auth');

Route::get('/proyectosAll', [ProyectosController::class, 'all'])
    ->name('proyectos_all')
    ->middleware('auth');

Route::get('/estadisticas', [ProyectosController::class, 'estadisticas'])
    ->name('proyectos.estadisticas')
    ->middleware('auth', 'admin');

Route::get('/resetear-passord/{id}', [User::class, 'password'])
    ->name('password.resetear')
    ->middleware('auth', 'admin');

Route::post('/avances-proyecto/{proyecto}', [ProyectosController::class, 'avances_proyecto'])
    ->name('avances-proyecto')
    ->middleware('auth');

Route::get('/datos-admin', [User::class, 'datos_admin'])
    ->name('datos.admin')
    ->middleware('auth', 'admin');

Route::post('/datos-admin/{id}/update', [User::class, 'admin_update'])
    ->name('admin.update')
    ->middleware('auth', 'admin');

Route::get('/filtro/{tipo}/{valor}', [ProyectosController::class, 'filtro'])
    ->name('filtro')
    ->middleware('auth', 'admin');

/**
 * Asignacion de proyectos
 */
Route::get('/asinar-evaludor/{proyecto}/{user}', [EvaluacionesController::class, 'asignar_evaluador'])
    ->name('asignar_evaluador')
    ->middleware('auth', 'admin');

Route::get('/asginados', [EvaluacionesController::class, 'proyectos_asigandos'])
    ->name('asigandos')
    ->middleware('auth', 'admin');

Route::get('/evaluar-proyecto/{proyecto}', [EvaluacionesController::class, 'evaluar_proyecto'])
    ->name('crear-evaluacion')
    ->middleware('auth', 'admin');

Route::get('/evaluar-proyecto-continuacion/{proyecto}', [EvaluacionesController::class, 'evaluar_continuacion'])
    ->name('evaluaciones.continuacion')
    ->middleware('auth', 'admin');



/**
 *
 * Reportes de excel
 */
/**
 * Evalauciones definitivas
 */
Route::get('/evaluacion-definitiva/{id}', [EvaluacionesController::class, 'definitivo'])->name('evaluacion.definitiva')->middleware('auth', 'admin');

/**
 * 
 * Reportes en PDF
 */

Route::get('/imprimir-evaluacion/{id}', [EvaluacionesController::class, 'imprimirEvaluacion'])->name('imprimirEvalaucion')->middleware('auth', 'admin');


Route::get('/resultados-evaluaciones/{tipo}', [EvaluacionesController::class, 'resultadosEvaluaciones'])->name('resultadosEvaluaciones');

Route::get('/all-reset-passwords', [User::class, 'all_resets_passwords']);


Route::get('local/file/{id}/{tipo}', [EvaluacionesController::class, 'getPDF'])->name('local.temp');

Route::post('/carta-confidecnialidad', [EvaluacionesController::class, 'cartas'])->name('carta.confidencialidad')->middleware('auth');

Route::resource('cartas-confidencialidad', CartaConfidencialidadController::class)->middleware('auth', 'admin');
