<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulos;
use App\Models\EnlaceModulo;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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
        $user = Auth::user();
        $permissionNames = $user->getPermissionsViaRoles();
        $modulos = DB::table('modulos_enlace')
        ->whereIn('enlace_permiso',$permissionNames->pluck('name')->toArray())
        ->get()
        ->groupBy('modulo_nombre');
        //return ($modulos);
        return view('home', compact('modulos'));
    }
    
}
