<?php

namespace App\Http\Controllers;

use App\Models\ciclos;
use App\Models\proyectos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ciclo = ciclos::where('activo', 1)->latest()->first();
        if (Auth::user()->role  == 'investigador' || Auth::user()->s_role == 'investigador') {
            $proyectos = proyectos::where('user_id', Auth::user()->id)->where('ciclo_id', $ciclo->id)->where('activo', 1)->count();
        } else {
            $proyectos = 0;
        }

        return view('home', compact('ciclo', 'proyectos'));
    }
}
