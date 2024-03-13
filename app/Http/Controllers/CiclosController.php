<?php

namespace App\Http\Controllers;

use App\Models\ciclos;
use Illuminate\Http\Request;

class CiclosController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $ciclos = ciclos::all();
        $ciclo = ciclos::where('activo', 1)->latest()->first();
        return view('ciclos.index', compact('ciclos', 'ciclo'));
    }

    public function create()
    {
        return view('ciclos.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'anio' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);
        ciclos::create([
            'anio' => $request->anio,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
        
    }
    public function cerrar($id)
    {
        $ciclo = ciclos::where('id', $id)->first();
        $ciclo->activo = 0;
        $ciclo->update();
        return redirect()->route('ciclos.index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'anio' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);

        $ciclo = ciclos::find($id);
        $ciclo->anio = $request->anio;
        $ciclo->fecha_inicio = $request->fecha_inicio;
        $ciclo->fecha_fin = $request->fecha_fin;
        $ciclo->update();
    }
}
