<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Modulos;
use Illuminate\Support\Arr;

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
        $mapped = Arr::map($permissionNames->pluck('name')->toArray(), function (string $value, string $key) {
            return explode('#', $value)[0];
        });
        $nombres = array_values(array_unique($mapped));

        $modulos = Modulos::with('enlaces')->select('id', 'nombre', 'permiso', 'icono', 'color')->whereIn('permiso', $nombres)->orderBy('nombre')->get();
        
        return view('home', compact('modulos'));
    }
}
