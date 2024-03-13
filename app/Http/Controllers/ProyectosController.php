<?php

namespace App\Http\Controllers;

use App\Models\ciclos;
use App\Models\proyectos;
use App\Models\User;
use App\Models\evaluaciones;
use App\Models\Recursos;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProyectosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all()
    {
        $ciclo = ciclos::latest()->first();
        if ($ciclo->id != null) {
            $proyectos = proyectos::where('activo', 1)
                ->where('ciclo_id', $ciclo->id)
                ->get();

            return view('proyectos.index', compact('proyectos'));
        } else {
            return view('home')->with([
                'message' => 'No hay ciclos registrados',
            ]);
        }
    }
    public function index()
    {
        $ciclo = ciclos::latest()->first();
        if ($ciclo->id != null) {
            $proyectos = proyectos::where('activo', 1)
                ->where('ciclo_id', $ciclo->id)
                ->where('user_id', Auth::user()->id)
                ->get();
            return view('proyectos.index', compact('proyectos'));
        } else {
            return view('home')->with([
                'message' => 'No hay ciclos registrados',
            ]);
        }
    }
    public function create()
    {
        $user = User::find(Auth::user()->id);
        $ciclo = ciclos::where('activo', 1)->first();
        $folio = proyectos::select('id')
            ->latest()
            ->first();
        if (!isset($folio->id)) {
            $id = 0;
        } else {
            $id = $folio->id;
        }
        $folio = strval($ciclo->anio) . '/' . strval($id + 1);
        return view('proyectos.create', compact('user', 'ciclo', 'folio'));
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

        $messages = [
            'tipo_registro.required' => 'Favor de ingresar el campo tipo de registro',
            'tipo_proyecto.required' => 'Favor de ingresar el campo tipo de proyecto',
            'sector.required' => 'Favor de ingresar el campo sector que impacta',
            'titulo.required' => 'Favor de ingresar el titulo',
            'abstract.required' => 'Favor de ingresar el resumen del proyecto',
            'justificacion_recursos.max:2000' => 'La justificaion es demasiado larga',
            'enfoque.required' => 'Favor de ingresar el enfoque al cual aplica el proyecto',
        ];

        $request->validate(
            [
                'titulo' => 'required',
                'tipo_registro' => 'required',
                'tipo_proyecto' => 'required',
                'sector' => 'required',
                'abstract' => 'required',
                'vinculacion_redes.0' => 'required',
                'justificacion_recursos' => 'max:2000',
                'enfoque' => 'required',
            ],
            $messages,
        );

        $proyecto = new proyectos();

        $proyecto->user_id = Auth::user()->id;
        $proyecto->evaluador_id = 1;
        $proyecto->ciclo_id = $ciclo->id;
        $proyecto->tipo_registro = $request->tipo_registro;
        $proyecto->tipo_proyecto = $request->tipo_proyecto;
        $proyecto->sector = $request->sector;

        $proyecto->titulo_proyecto = $request->titulo;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->abstract = $request->abstract;
        $proyecto->enfoque = $request->enfoque;

        if (count($request->personal) > 0) {
            $proyecto->personal = implode('<separador>', $request->personal);
        }

        $proyecto->recursos_concurrentes = $request->recursos_concurrentes;

        $proyecto->divulgacion = implode('<separador>', $request->divulgacion);
        if (isset($request->otro)) {
            $proyecto->otros = $request->otro;
        }

        if (strcmp($request->otras_intituciones[0], 'Si') == 0 && isset($request->otras_intituciones[1])) {
            $proyecto->otras_instituciones = $request->otras_intituciones[1];
        }

        if (strcmp($request->vinculacion_cuerpos[0], 'Si') == 0 && isset($request->vinculacion_cuerpos[1])) {
            $proyecto->vinculacion_ca = $request->vinculacion_cuerpos[1];
        }

        if (strcmp($request->vinculacion_redes[0], 'Si') == 0 && isset($request->vinculacion_redes[1])) {
            $proyecto->vinculacion_redes = $request->vinculacion_redes[1];
        }

        //  -- Archivos  --
        if ($request->hasfile('anexos')) {
            $archivo = $request->file('anexos');
            $nombre = $request->folio . '_' . Auth::user()->name . '.pdf';
            $nombre = str_replace('/', '_', $nombre);

            \Storage::disk('anexos')->put($nombre, \File::get($archivo));
            $proyecto->anexo = $nombre;
        }

        if ($request->hasfile('cronograma')) {
            $archivo = $request->file('cronograma');
            $nombre = $request->folio . '_' . Auth::user()->name . '.pdf';
            $nombre = str_replace('/', '_', $nombre);
            \Storage::disk('cronogramas')->put($nombre, \File::get($archivo));
            $proyecto->cronograma = $nombre;
        }
        $recurso = new Recursos();
        for ($i = 0; $i < 8; $i++) {
            $numero = 'p_0' . strval($i + 1);
            $recurso->$numero = $request->recursos[$i];
        }
        if (isset($request->justificacion_recursos)) {
            $recurso->justificacion = $request->justificacion_recursos;
        }

        //return $proyecto;
        $recurso->save();

        $proyecto->recursos_id = $recurso->id;
        $proyecto->save();

        return redirect()
            ->route('home')
            ->with([
                'message' => 'El proyecto se registro exitosamente',
            ]);
    }
    public function show(proyectos $proyecto)
    {
        if ($proyecto->user_id == Auth::user()->id || Auth::user()->role == 'admin' || Auth::user()->s_role == 'admin') {
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

            return view('proyectos.show', compact('proyecto'));
        } else {
            return redirect()->route('home');
        }
    }
    public function edit(proyectos $proyecto)
    {
        $proyecto->personal = explode('<separador>', $proyecto->personal);
        $proyecto->divulgacion = explode('<separador>', $proyecto->divulgacion);
        return view('proyectos.edit', compact('proyecto'));
    }

    public function update(Request $request, proyectos $proyecto)
    {
        $messages = [
            'tipo_registro.required' => 'Favor de ingresar el campo Tipo de registro',
            'tipo_proyecto.required' => 'Favor de ingresar el campo Tipo de proyecto',
            'sector.required' => 'Favor de ingresar el campo sector que impacta',
            'titulo.required' => 'Favor de ingresar el Titulo',
            'abstract.required' => 'Favor de ingresar el resumen del proyecto',
            'justificacion_recursos.max' => 'La justificacion de los recursos es demasiado larga',
            'enfoque.required' => 'Favor de ingresar el enfoque al cual aplica el proyecto',
        ];

        $request->validate(
            [
                'titulo' => 'required',
                'tipo_registro' => 'required',
                'tipo_proyecto' => 'required',
                'sector' => 'required',
                'abstract' => 'required',
                'justificacion_recursos' => 'max:2000',
                'enfoque' => 'required',
            ],
            $messages,
        );

        $proyecto->ciclo_id = $proyecto->ciclo->id;
        $proyecto->tipo_registro = $request->tipo_registro;
        $proyecto->tipo_proyecto = $request->tipo_proyecto;
        $proyecto->sector = $request->sector;
        $proyecto->evaluador_id = 1;
        $proyecto->titulo_proyecto = $request->titulo;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->abstract = $request->abstract;
        $proyecto->enfoque = $request->enfoque;

        $proyecto->personal = implode('<separador>', $request->personal);
        $proyecto->recursos_concurrentes = $request->recursos_concurrentes;
        $proyecto->divulgacion = implode('<separador>', $request->divulgacion);

        $recurso = Recursos::find($proyecto->recursos->id);

        for ($i = 0; $i < 8; $i++) {
            $numero = 'p_0' . strval($i + 1);
            $recurso->$numero = $request->recursos[$i];
        }

        if (isset($request->justificacion_recursos)) {
            $recurso->justificacion = $request->justificacion_recursos;
        }
        $recurso->update();

        if (isset($request->otro)) {
            $proyecto->otros = $request->otro;
        }

        if (strcmp($request->otras_intituciones[0], 'Si') == 0 && isset($request->otras_intituciones[1])) {
            $proyecto->otras_instituciones = $request->otras_intituciones[1];
        }

        if (strcmp($request->vinculacion_cuerpos[0], 'Si') == 0 && isset($request->vinculacion_cuerpos[1])) {
            $proyecto->vinculacion_ca = $request->vinculacion_cuerpos[1];
        }

        if (strcmp($request->vinculacion_redes[0], 'Si') == 0 && isset($request->vinculacion_redes[1])) {
            $proyecto->vinculacion_redes = $request->vinculacion_redes[1];
        }

        if ($request->hasfile('anexos')) {
            $archivo = $request->file('anexos');
            $nombre = $request->folio . '_' . Auth::user()->name . '.pdf';
            $nombre = str_replace('/', '_', $nombre);

            \Storage::disk('anexos')->put($nombre, \File::get($archivo));
            $proyecto->anexo = $nombre;
        }

        if ($request->hasfile('cronograma')) {
            $archivo = $request->file('cronograma');
            $nombre = $request->folio . '_' . Auth::user()->name . '.pdf';
            $nombre = str_replace('/', '_', $nombre);
            \Storage::disk('cronogramas')->put($nombre, \File::get($archivo));
            $proyecto->cronograma = $nombre;
        }
        $proyecto->save();
        return redirect()
            ->route('home')
            ->with([
                'message' => 'El proyecto se modifico exitosamente',
            ]);
    }
    public function proyecto_definitivo($id)
    {
        $proyecto = proyectos::find($id);
        if ($proyecto->definitivo == 0) {
            $proyecto->definitivo = 1;
        } else {
            $proyecto->definitivo = 0;
        }
        $proyecto->update();
        return redirect()
            ->route('home')
            ->with([
                'message' => 'El proyecto se actualizo correctamente',
            ]);
    }
    public function imprimirProyecto($id)
    {
        $proyecto = proyectos::find($id);
        $proyecto->personal = explode('<separador>', $proyecto->personal);

        $proyecto->divulgacion = explode('<separador>', $proyecto->divulgacion);

        $total = 0;

        for ($i = 0; $i < 13; $i++) {
            $numero = 'p_0' . strval($i + 1);
            $total = $total + $proyecto->recursos->$numero;
        }
        $proyecto->monto_total = $total;
        $pdf = \PDF::loadView('proyectos.imprimirPDF', compact('proyecto'));
        return $pdf->stream('formatoProyecto.pdf');
    }

    public function delete($id)
    {
        $proyecto = proyectos::find($id);
        if ($proyecto->user_id == Auth::user()->id || Auth::user()->role =='admin' || Auth::user()->s_role =='admin') {
            $proyecto->activo = 0;
            $proyecto->update();
            return redirect()
                ->route('home')
                ->with([
                    'message' => 'El proyecto se elimino correctamente',
                ]);
        }
    }
    /***
     *
     * Estadisticas de los proyectos
     */

    public function estadisticas()
    {
        $ciclo = ciclos::latest()->first();

        $departamentos = $this->departamento($ciclo);

        $total = proyectos::where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->count();

	$evaluados = evaluaciones::select('dictamen', DB::raw('count(*) as Total_registros'))
            ->where('definitivo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->groupBy('dictamen')->orderBy('Total_registros', 'desc')
            ->pluck('Total_registros', 'dictamen');
	
	// Aceptados Proyectos nuevos // Aprobados Proyectos continuacion  // No aceptados
	//dd($evaluados );


        // Obtener las cantidades de cada uno de los registros
        $tipo_registro = proyectos::select('tipo_registro', DB::raw('count(*) as Total_registros'))
            ->where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->groupBy('tipo_registro')->orderBy('Total_registros', 'desc')
            ->pluck('Total_registros', 'tipo_registro');

        $tipo_proyecto = proyectos::select('tipo_proyecto', DB::raw('count(*) as Total_registros'))
            ->where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->groupBy('tipo_proyecto')->orderBy('Total_registros', 'desc')
            ->pluck('Total_registros', 'tipo_proyecto');

        $sector = proyectos::select('sector', DB::raw('count(*) as Total_registros'), 'ciclo_id')
            ->where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->groupBy('sector')->orderBy('Total_registros', 'desc')
            ->pluck('Total_registros', 'sector');    
       
         $recursos = proyectos::where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->get();

        //$recursos = $recursos->where('total', '>', 0);

        $apoyo = [ 'Con apoyo' => $recursos->where('total', '>', 0)->count(),'Sin apoyo' => $total - $recursos->where('total', '>', 0)->count() ];
        $definitivos = proyectos::select('definitivo')
            ->where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->where('definitivo', 1)
            ->count();

        $definitivo['total'] = $definitivos;
        $definitivo['progreso'] = ($definitivos * 100) / $total;


        $arreglo = ['Apoyo económico' => $apoyo, 'Tipo registro' => $tipo_registro->all(), 'Tipo proyecto' => $tipo_proyecto, 'Sector' => $sector];

        return view('estadisticas.estadisticas', compact('arreglo', 'total', 'definitivo', 'departamentos','evaluados'));
    }

    public function avances_proyecto(Request $request, proyectos $proyecto)
    {
        $archivo = $request->file('avances');
        $nombre = $request->folio . '_' . Auth::user()->name . '.pdf';
        $nombre = str_replace('/', '_', $nombre);
        \Storage::disk('continuacion')->put($nombre, \File::get($archivo));

        $proyecto->avances = $nombre;
        $proyecto->update();
        return redirect()
            ->route('home')
            ->with([
                'message' => 'El proyecto se actualizo correctamente',
            ]);
    }

    public function departamento($ciclo)
    {
        $departamento = proyectos::join('datos_generales', 'proyectos.user_id', '=', 'datos_generales.user_id')
            ->select('proyectos.*', 'datos_generales.*', DB::raw('count(*) as Total_registros'))
            ->where('activo', 1)
            ->groupBy('datos_generales.departamento')
            ->where('ciclo_id', $ciclo->id)
            ->orderBy('Total_registros', 'desc')
            ->get();
        return $departamento = $departamento->pluck('Total_registros', 'departamento');
    }

    public function filtro($tipo, $valor)
    {
        $ciclo = ciclos::latest()->first();
        $proyectos = proyectos::with('recursos', 'user', 'ciclo', 'evaluacion')
            ->join('datos_generales', 'datos_generales.user_id', '=', 'proyectos.user_id')
            ->where('activo', 1)
            ->where('ciclo_id', $ciclo->id)
            ->get(['proyectos.*', 'datos_generales.division', 'datos_generales.departamento']);

        $titulos = ['Id', 'Folio', 'Título', 'Nombre', 'División', 'Departamento'];
        $columnas = [['target' => 0, 'visible' => false]];

        if (strcmp($valor, 'Con apoyo') == 0) {
            return $this->recursos($proyectos,  $columnas, $titulos,$tipo,$valor);
        }

        if (strcmp($valor, 'Sin apoyo') == 0) {
            $proyectos = $proyectos->where('total', '=', 0);
            $proyectosFin = $this->conFiltro($proyectos,$tipo);
            return view('reportes.recursos', compact('proyectosFin', 'columnas', 'titulos', 'tipo', 'valor'));
        }
	
	array_push($titulos,$tipo,'Tipo registro','Total');
        array_push($columnas,['target' => 6, 'visible' => false],['target' => 7, 'visible' => false],['target' => 8, 'visible' => false]);
        $proyectos = $proyectos->where($tipo, $valor);
        $proyectosFin = $this->conFiltro($proyectos,$tipo);
        return view('reportes.recursos', compact('proyectosFin', 'columnas', 'titulos', 'tipo', 'valor'));
    }
    /**
     * Funciones para reportes
     */

    public function recursos($proyectos, $columnas, $titulos,$tipo,$valor)
    {
        // Se añaden los header a la tabla
        $temp = ['Total','Tipo registro', '3711', '3721', '3722', '3751', '3753', '2611', '2111', '2141'];
        $titulos = array_merge($titulos, $temp);
        // Se ocultan los campos de los recursos
        for ($i = 7; $i <= 15; $i++) {
            array_push($columnas, ['target' => $i, 'visible' => false]);
        }
        $total = 0;
        $proyectosFin = [];
        $proyectos = $proyectos->where('total', '>', 0);
        foreach ($proyectos as $key => $value) {
            $data = [$value['id'], $value['folio'], ucfirst($value['titulo_proyecto']), $value['user']['name'], $value['division'], $value['departamento'],$value['total'],$value['tipo_registro']];
            $data_recurso = [$value['recursos']['p_01'], $value['recursos']['p_02'], $value['recursos']['p_03'], $value['recursos']['p_04'], $value['recursos']['p_05'], $value['recursos']['p_06'], $value['recursos']['p_07'], $value['recursos']['p_08']];
            $data = array_merge($data, $data_recurso);
            array_push($proyectosFin, $data);
            $total = $total + $value->total;
        }
        return view('reportes.recursos', compact('proyectosFin', 'columnas', 'total', 'titulos','tipo','valor'));
    }

    public function conFiltro($proyectos,$tipo)
    {
        $proyectosFin = [];

        foreach ($proyectos as $key => $value) {
            array_push($proyectosFin, [$value['id'], $value['folio'], $value['titulo_proyecto'], $value['user']['name'], $value['division'], $value['departamento'],$value[$tipo],$value['tipo_registro'],$value['total']]);        }

        return $proyectosFin;
    }
}