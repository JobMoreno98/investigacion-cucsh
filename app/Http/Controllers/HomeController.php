<?php

namespace App\Http\Controllers;

use App\Models\ciclos;
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
        $ciclo = ciclos::where('activo',1)->latest()->first();
        return view('home',compact('ciclo'));
    }
}
