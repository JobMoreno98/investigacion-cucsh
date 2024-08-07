<?php

namespace App\Http\Controllers;

use App\Models\CartaConfidencialidad;
use App\Models\ciclos;
use App\Models\evaluaciones;
use App\Models\proyectos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class EvaluacionesController extends Controller
{
    public function index()
    {
        $ciclo = ciclos::latest()->first();
        if (isset($ciclo->id)) {
            $proyectos = proyectos::with('evaluador', 'user', 'evaluacion')
                ->where('activo', 1)
                ->where('ciclo_id', $ciclo->id)
                ->where('definitivo', 1)
                ->where('tipo_registro', 'Proyecto nuevo')
                ->get();

            return view('evaluaciones.index', compact('proyectos'));
        } else {
            Alert::danger('Error', 'No hay ciclos registrados');
            return view('home');
        }
    }
    public function show($id)
    {
        $proyecto = proyectos::find($id);

        $proyecto->personal = explode('<separador>', $proyecto->personal);

        $proyecto->divulgacion = explode('<separador>', $proyecto->divulgacion);

        $total = 0;

        for ($i = 0; $i < 8; $i++) {
            if ($i < 9) {
                $numero = 'p_0' . strval($i + 1);
            } else {
                $numero = 'p_' . strval($i + 1);
            }
            $total = $total + $proyecto->recursos->$numero;
        }
        $proyecto->monto_total = $total;

        $evalaudores = User::permission('EVALUADOR#ver')->get();
        /* $evalaudores = User::where('role', '=', 'evaluador')
            ->orWhere('s_role', '=', 'evaluador')
            ->get();*/
        return view('evaluaciones.show', compact('evalaudores', 'proyecto'));
    }

    public function store(Request $request)
    {
        $ciclo = ciclos::where('activo', 1)->first();
        if (!isset($ciclo->id)) {
            return redirect()
                ->route('home')
                ->with([
                    'error' => 'No hay ciclo activo de registro',
                ]);
        }

        $proyecto = proyectos::where('id', $request->id_proyecto)->first();
        // Registro de evalaucionde proyectois nuevos

        if (strcmp($proyecto->tipo_registro, 'Proyecto nuevo') == 0) {
            $evaluacion = $this->nuevos($request, $ciclo);
        } else {
            $evaluacion = $this->continuacion($request, $ciclo);
        }
        $proyecto->evaluador_id = $evaluacion->evaluador_id;
        $proyecto->evaluacion_id = $evaluacion->id;
        $proyecto->update();

        Alert::success('Exito', 'Se guardo correctamente la evaluación');
        return redirect()->route('evaluador-proyectos', $evaluacion->evaluador_id);
    }
    public function edit($id)
    {
        $evaluacion = evaluaciones::with('proyecto')->find($id);
        if (strcmp($evaluacion->proyecto->tipo_registro, 'Proyecto nuevo') == 0) {
            for ($i = 0; $i < 13; $i++) {
                if ($i < 9) {
                    $numero = 'p_0' . strval($i + 1);
                } else {
                    $numero = 'p_' . strval($i + 1);
                }

                $evaluacion->$numero = explode('<separador>', $evaluacion->$numero);
            }
            return view('evaluador.edit', compact('evaluacion'));
        } else {
            $proyecto = $evaluacion->proyecto;
            return view('evaluador.edit-continuacion', compact('evaluacion', 'proyecto'));
        }
    }

    public function update(Request $request, $id)
    {
        $proyecto = proyectos::where('evaluacion_id', $id)->first();

        $ciclo = ciclos::where('activo', 1)->first();
        if (strcmp($proyecto->tipo_registro, 'Proyecto nuevo') == 0) {
            $array = [];
            for ($i = 0; $i < 13; $i++) {
                if ($i < 9) {
                    $numero = 'p_0' . strval($i + 1) . '.1';
                } else {
                    $numero = 'p_' . strval($i + 1) . '.1';
                }
                $array[$numero] = 'required';
            }
            $array['dictamen'] = 'required';
            $request->validate($array);
            $evaluacion = $this->nuevos($request, $ciclo);
        } else {
            $evaluacion = $this->continuacion($request, $ciclo);
        }
        Alert::success('Exito', 'Se guardo correctamente');
        return redirect()->route('home');

        $evaluacion = evaluaciones::find($id);

        if (!isset($ciclo->id)) {
            return redirect()
                ->route('home')
                ->with([
                    'error' => 'No hay ciclo activo de registro',
                ]);
        }
        $evaluacion->dictamen = $request->dictamen;
        if (isset($request->sugerencias)) {
            $evaluacion->observaciones = $request->sugerencias;
        }
        $evaluacion->update();
    }

    public function asignar_evaluador(proyectos $proyecto, User $user)
    {
        $ciclo = ciclos::latest()->first();
        $evaluacion = evaluaciones::updateOrCreate(
            [
                'proyecto_id' => $proyecto->id,
            ],
            [
                'users_id ' => 1,
                'proyecto_id' => $proyecto->id,
                'evaluador_id' => $user->id,
                'ciclo_id' => $ciclo->id,
            ],
        );
        $proyecto->evaluador_id = $user->id;

        $proyecto->evaluacion_id = $evaluacion->id;
        $proyecto->update();

        Alert::success('Exito', 'Se asigno correctamente el evalaudor');
        return redirect()->route('home');
    }

    public function proyectos_asigandos()
    {
        $ciclo = ciclos::latest()->first();
        $asigandos = evaluaciones::with('proyecto')
            ->where('ciclo_id', $ciclo->id)
            ->where('dictamen', '!=', '-')
            ->get();

        return view('evaluaciones.asigandos', compact('asigandos'));
    }

    public function evaluaciones_index($id, $id_ciclo = null)
    {
        if (is_null($id_ciclo)) {
            $ciclo = ciclos::latest()->first();
        } else {
            $ciclo = ciclos::find($id_ciclo);
        }
        if (isset($ciclo)) {
            $proyectos = evaluaciones::with('proyecto', 'user')
                ->where('evaluador_id', $id)
                ->where('ciclo_id', $ciclo->id)
                ->get();

            return view('evaluador.proyectos', compact('proyectos'));
        }
        //Alert::info('Alerta','Aun no se han abierto periodos de registro de proyectos');
        //toast('Your Post as been submited!','info')->hideCloseButton();
        // example:
        toast('Aun no se han abierto periodos de registro de evaluaciones', 'info')->hideCloseButton()->timerProgressBar();
        return redirect()->route('home');
    }

    public function evaluar_proyecto(proyectos $proyecto)
    {
        return view('evaluador.create', compact('proyecto'));
    }

    public function evaluar_continuacion(proyectos $proyecto)
    {
        return view('evaluaciones.continuacion', compact('proyecto'));
    }

    /**
     * Evaluacion de poryectos nuevos
     */

    public function nuevos(Request $request)
    {
        $array = [];
        for ($i = 0; $i < 13; $i++) {
            if ($i < 9) {
                $numero = 'p_0' . strval($i + 1) . '.1';
            } else {
                $numero = 'p_' . strval($i + 1) . '.1';
            }
            $array[$numero] = 'required';
        }
        $array['dictamen'] = 'required';
        $request->validate($array);
        $evaluacion = evaluaciones::where('proyectos_id', $request->id_proyecto)->first();
        for ($i = 0; $i < 13; $i++) {
            if ($i < 9) {
                $numero = 'p_0' . strval($i + 1);
            } else {
                $numero = 'p_' . strval($i + 1);
            }

            $evaluacion->$numero = implode('<separador>', $request->$numero);
        }
        $evaluacion->dictamen = $request->dictamen;
        if (isset($request->sugerencias)) {
            $evaluacion->observaciones = $request->sugerencias;
        }
        $evaluacion->save();
        return $evaluacion;
    }
    /**
     * Evaluacion de poryectos de continuacion
     */
    public function continuacion(Request $request, $ciclo)
    {
        $request->validate([
            'avance' => 'required',
            'informe' => 'required',
            'recursos.0' => 'required',
            'dictamen' => 'required',
        ]);

        $evaluacion = evaluaciones::where('proyectos_id', $request->id_proyecto)->first();
        $flag = 0;

        if (!isset($evaluacion->id)) {
            $evaluacion = new evaluaciones();
            $flag = 1;
        }

        $evaluacion->proyectos_id = $request->id_proyecto;

        $evaluacion->avance = $request->avance;
        $evaluacion->informe = $request->informe;
        $evaluacion->recursos = $request->recursos[0];

        for ($i = 1; $i < 9; $i++) {
            $numero = 'p_0' . strval($i);
            $evaluacion->$numero = $request->recursos[$i];
        }
        $evaluacion->ciclo_id = $ciclo->id;
        $evaluacion->evaluador_id = Auth::user()->id;
        $evaluacion->dictamen = $request->dictamen;
        $evaluacion->definitivo = 1;
        if ($flag == 0) {
            $evaluacion->update();
        } else {
            $evaluacion->save();
        }
        return $evaluacion;
    }

    public function definitivo($id)
    {
        $evaluacion = evaluaciones::find($id);
        $evaluacion->definitivo = 1;
        $evaluacion->update();
        Alert::success('Exito', 'Se guardo correctamente');
        return redirect()->route('home');
    }

    public function imprimirEvaluacion($id)
    {
        $evaluacion = evaluaciones::with('proyecto', 'evaluador')->where('proyectos_id', $id)->first();

        $proyecto = $evaluacion->proyecto;

        if (strcmp($proyecto->tipo_registro, 'Proyecto nuevo') == 0) {
            for ($i = 0; $i < 14; $i++) {
                if ($i <= 9) {
                    $numero = 'p_0' . strval($i);
                } else {
                    $numero = 'p_' . strval($i);
                }
                $evaluacion->$numero = explode('<separador>', $evaluacion->$numero);
            }
            $pdf = \PDF::loadView('evaluaciones.imprimirPDF', compact('proyecto', 'evaluacion'));
            return $pdf->stream('formatoProyecto.pdf');
        }

        $totalAprobado = 0;
        for ($i = 0; $i < 9; $i++) {
            $numero = 'p_0' . strval($i);
            $totalAprobado = $totalAprobado + $evaluacion->$numero;
        }

        $evaluacion->total = $totalAprobado;
        $pdf = \PDF::loadView('evaluaciones.imprimirPDFContinuacion', compact('proyecto', 'evaluacion'));
        return $pdf->stream('formatoProyecto.pdf');
    }

    public function resultadosEvaluaciones($tipo)
    {
        $ciclo = ciclos::latest()->first();

        $temp = proyectos::with('evaluacion', 'ciclo')
            ->where('ciclo_id', $ciclo->id)
            ->get();
        $proyectos = $temp->where('dictamen', $tipo);

        return view('reportes.resultados', compact('proyectos', 'tipo'));
    }

    public function getPDF($data, $tipo)
    {
        $proyecto = proyectos::select('extenso', 'cronograma')->where('id', $data)->first();

        if (strcmp('extenso', $tipo) == 0) {
            $filename = 'proyecto.pdf';
            $disk = Storage::disk('extenso')->get($proyecto->extenso);
            return response()->make($disk, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        }

        if (strcmp('cronograma', $tipo) == 0) {
            $filename = 'cronograma.pdf';
            $disk = Storage::disk('cronogramas')->get($proyecto->cronograma);
            return response()->make($disk, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        }
        if (strcmp('completo', $tipo) == 0) {
            return redirect()->route('imprimirProyecto', $data);
        }
    }
    public function cartas(Request $request)
    {
        $messages = [
            'carta.between' => 'El archivo debe de pesar ente 1MB y 5MB',
        ];
        $request->validate(
            [
                'carta' => 'required|file|mimes:pdf|between:1,5120',
            ],
            $messages,
        );

        if ($request->hasfile('carta')) {
            $anio = date('Y');
            $archivo = $request->file('carta');
            $nombre = \Str::lower(Auth::user()->name) . '.pdf';
            $nombre = str_replace('/', '_', $nombre);
            $nombre = str_replace(' ', '_', $nombre);
            Storage::disk('cartas')->put($anio . '/' . $nombre, \File::get($archivo));
            CartaConfidencialidad::updateOrCreate(
                ['user_id' => Auth::user()->id, 'anio' => $anio],
                [
                    'name' => $nombre,
                    'user_id' => Auth::user()->id,
                    'anio' => $anio,
                ],
            );
            Alert::success('Exito', 'Se ha subido su documento de manera satisfactoria');
            return redirect()->route('home');
        }
    }
}
