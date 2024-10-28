<?php

namespace App\Http\Controllers;

use App\Models\CartaConfidencialidad;
use Illuminate\Http\Request;

class CartaConfidencialidadController extends Controller
{
    public function index()
    {
        $anio = date('Y');
        $cartas = CartaConfidencialidad::with('user')->where('anio', $anio)->get();
        return view('cartas.index',compact('cartas'));
    }
}
