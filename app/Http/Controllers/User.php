<?php

namespace App\Http\Controllers;

use App\Models\ciclos;
use App\Models\datosGenerales;
use App\Models\proyectos;
use App\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\Password_reset;

class User extends Controller
{
    public function index()
    {
        $users = ModelsUser::with('datos')
            ->where('id', '!=', Auth::user()->id)
            ->get();
        $total_role = ModelsUser::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role')->toArray();

        $total_s_role = ModelsUser::select('s_role', DB::raw('count(*) as total'))
            ->where('s_role', '!=', null)
            ->groupBy('s_role')
            ->pluck('total', 's_role')->toArray();

        $totales = array_merge_recursive($total_s_role, $total_role);

        return view('usuarios.index', compact('users', 'totales'));
    }

    public function datos_generales()
    {
        $user = ModelsUser::find(Auth::user()->id);
        return view('usuarios.datos_generales', compact('user'));
    }
    public function update(Request $request, $user)
    {
        $messages = [
            'email.required' => 'El correo es requerido',
            'email.unique' => 'Ya hay un usuario registrado con ese correo',
            'email.email' => 'Ya hay un usuario registrado con ese correo',
            'nombramiento.required' => 'Favor de ingresar tu Nombramiento',
            'cuerpo_academico.required' => 'Favor de ingresar tu Cuerpo Académico',
            'reconocimiento_sni.required' => 'Favor de ingresar tu Reconocimiento S.N.I',
            'reconocimiento_promep.required' => 'Favor de ingresar tu Reconocimiento PROMEP',
            'reconocimiento_proesde.required' => 'Favor de ingresar tu Reconocimiento PROESDE',
            'departamento.required' => 'Favor de ingresar tu Departamento',
            'division.required' => 'Favor de ingresar tu División',
            'email.ends_with' => 'El correo debe ser @academicos.udg.mx'
        ];
        $request->validate(
            [
                'email' => 'required|email|unique:users,email,' . Auth::user()->id,
                'nombramiento' => 'required',
                'cuerpo_academico' => 'required',
                'reconocimiento_sni' => 'required',
                'reconocimiento_promep' => 'required',
                'reconocimiento_proesde' => 'required',
                'departamento' => 'required',
                'division' => 'required'
            ],
            $messages,
        );

        //return $request->nombramiento;
        $user = ModelsUser::find($user);

        $user->name = $request->name;
        $user->email = $request->email;

        if (isset($request->password)) {
            $rules = [
                'password' => 'required|confirmed|min:6|max:18',
            ];

            $messages = [
                'password.required' => 'El campo es requerido',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'El mínimo permitido son 6 caracteres',
                'password.max' => 'El máximo permitido son 18 caracteres',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if (!$validator->fails()) {
                $user->password = Hash::make($request->password);
                $user->reseteo = 0;
            } else {
                return redirect()
                    ->route('datos_generales', $user)
                    ->withErrors($validator);
            }
        }
        $datos = datosGenerales::where('user_id', $user->id)->first();
        if ($datos) {
            $datos->nombramiento = $request->nombramiento;
            $datos->cuerpo_academico = $request->cuerpo_academico;
            $datos->reconocimiento_sni = $request->reconocimiento_sni;
            $datos->reconocimiento_promep = $request->reconocimiento_promep;
            $datos->reconocimiento_proesde = $request->reconocimiento_proesde;
            $datos->departamento = $request->departamento;
            $datos->division = $request->division;
            $datos->update();
        } else {
            $datos = new datosGenerales();
            $datos->user_id = $user->id;
            $datos->nombramiento = $request->nombramiento;
            $datos->cuerpo_academico = $request->cuerpo_academico;
            $datos->reconocimiento_sni = $request->reconocimiento_sni;
            $datos->reconocimiento_promep = $request->reconocimiento_promep;
            $datos->reconocimiento_proesde = $request->reconocimiento_proesde;
            $datos->departamento = $request->departamento;
            $datos->division = $request->division;
            $datos->save();
        }

        $user->update();

        return redirect()
            ->route('home')
            ->with('message', 'Sus datos se han actualizado correctamente');
    }
    public function role($id)
    {
        $usuario = ModelsUser::find($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function usuario_update(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required',
        ]);

        $usuario = ModelsUser::find($id);
        $usuario->role = $request->rol;

        if (strcmp($request->s_rol, 'ninguno') == 0) {
            $usuario->s_role = null;
        }
        if (strcmp($request->s_rol, 'ninguno') != 0) {
            $usuario->s_role = $request->s_rol;
        }
        $usuario->update();
        return redirect()->route('usuarios.index');
    }

    public function password($id)
    {
        $usuario = ModelsUser::find($id);
        $contraseña = 'cucsh2024';
        $usuario->password = Hash::make($contraseña);
        $usuario->reseteo = 1;
        $usuario->update();

        Mail::to($usuario->email)->send(new Password_reset($usuario, $contraseña));
        $mensaje = 'Se restablecio correctamente la contraseña, un correo se ha mandado a ' . $usuario->email . ' con la nueva contraseña';

        return redirect()
            ->route('usuario.edit', $usuario->id)
            ->with('message', $mensaje);
    }

    public function datos_admin()
    {
        return view('admin.index');
    }

    public function admin_update(Request $request, $id)
    {
        $messages = [
            'email.required' => 'El correo es requerido',
            'email.unique' => 'Ya hay un usuario registrado con ese correo',
            'email.email' => 'Ya hay un usuario registrado con ese correo',
            'email.ends_with' => 'El correo debe ser @academicos.udg.mx',
        ];
        $request->validate(
            [
                'email' => 'required|email|ends_with:academicos.udg.mx|unique:users,email,' . $id,
            ],
            $messages,
        );

        $user = ModelsUser::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if (isset($request->password)) {
            $rules = [
                'password' => 'required|confirmed|min:6|max:18',
            ];
            $messages = [
                'password.required' => 'El campo es requerido',
                'password.confirmed' => 'Las contraseñas no coinciden',
                'password.min' => 'El mínimo permitido son 6 caracteres',
                'password.max' => 'El máximo permitido son 18 caracteres',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if (!$validator->fails()) {
                $user->password = Hash::make($request->password);
                $user->reseteo = 0;
            } else {
                return redirect()
                    ->route('datos.admin')
                    ->withErrors($validator);
            }
        }
        $user->update();

        return redirect()
            ->route('home')
            ->with('message', 'Sus datos se han actualizado correctamente');
    }
    public function all_resets_passwords()
    {
        $users = ModelsUser::all();

        foreach ($users as $key => $value) {
            $contraseña = 'cucsh2024';
            $value->password = Hash::make($contraseña);
            $value->update();
        }
        echo "FIN";
    }
}
