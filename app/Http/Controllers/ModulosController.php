<?php

namespace App\Http\Controllers;
use App\Models\Modulos;
use App\Models\EnlaceModulo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ModulosController extends Controller
{
    public function index()
    {
        $modulos = Modulos::all();
        return view('modulos.index', compact('modulos'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'permiso' => 'required',
        ]);
        $modulo = Modulos::create([
            'nombre' => \Str::upper($request->nombre),
            'icono' => isset($request->icono) ? $request->icono : 'info',
            'color' => isset($request->color) ? $request->color : '#e2e2e2',
            'permiso' => $request->permiso,
            'orden' => $request->orden
        ]);
        alert()->success('Exito', 'Se ha registrado el modulo de manera exitosa')->persistent(true, false);
        return redirect()->route('modulos.index');
    }
    public function edit(Modulos $modulo)
    {
        $enlaces = EnlaceModulo::where('modulo_id', $modulo->id)
            ->get();
        return view('modulos.edit', compact('modulo', 'enlaces'));
    }
    public function update(Request $request, Modulos $modulo)
    {
        $modulo->update([
            'nombre' => $request->nombre,
            'icono' => $request->icono,
            'color' => $request->color,
            'permiso' => $request->permiso,
            'orden' => $request->orden,
        ]);
        if (isset($request->enlaces) && isset($request->titulo)) {
            $enlaces = array_combine($request->enlaces, $request->titulo);
            $parametros = $request->parametros;
            $permisos = $request->permisos;
            $cont = 0;
            foreach ($enlaces as $key => $value) {
                EnlaceModulo::updateOrCreate(
                    ['modulo_id' => $modulo->id, 'enlace' => $key],
                    [
                        'modulo_id' => $modulo->id,
                        'enlace' => $key,
                        'permiso' => $permisos[$cont],
                        'titulo' => $value,
                        'parametro' => $parametros[$cont],
                        'estilo' => isset($request->estilos[$cont]) ? $request->estilos[$cont] : 'btn btn-outline-success  btn-sm m-1',
                        'activo' => 1,
                    ],
                );
                $cont += 1;
            }
        }

        return redirect()->route('modulos.index');
    }
    public function eliminar_enlace(Request $request)
    {
        $enlace = EnlaceModulo::where('id', $request->id)->first();
        if ($enlace->delete()) {
            Alert::success('SUCCESS', 'SE HA DESACTIVADO EL ENALCE');
            return 'Se elimino correctamente';
        }
        Alert::danger('DANGER', 'OCURRIO UN ERROR AL DESACTIVAR EL ENALCE');
        return 'Hubo un error al eliminar';
    }

    public function destroy($id)
    {
        $modulo = Modulos::find($id);
        $modulo->activo = 0;
        if ($modulo->update()) {
            Alert::success('SUCCESS', 'SE HA DESACTIVADO EL ENALCE');
            return redirect()->route('modulos.index');
        }
        Alert::danger('DANGER', 'OCURRIO UN ERROR AL DESACTIVAR EL ENALCE');
        return redirect()->route('modulos.index');
    }
}
