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
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class User extends Controller
{
    public function index()
    {
        $users = ModelsUser::all();
        return view('admin.usuarios.index', compact('users'));
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
            'email.ends_with' => 'El correo debe ser @academicos.udg.mx',
        ];
        $request->validate(
            [
                'nombramiento' => 'required',
                'cuerpo_academico' => 'required',
                'reconocimiento_sni' => 'required',
                'reconocimiento_promep' => 'required',
                'reconocimiento_proesde' => 'required',
                'departamento' => 'required',
                'division' => 'required',
            ],
            $messages,
        );

        //return $request->nombramiento;
        $user = ModelsUser::find($user);
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

        return redirect()->route('home')->with('message', 'Sus datos se han actualizado correctamente');
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
                return redirect()->route('datos.admin')->withErrors($validator);
            }
        }
        $user->update();

        return redirect()->route('home')->with('message', 'Sus datos se han actualizado correctamente');
    }
    public function all_resets_passwords()
    {
        $users = ModelsUser::all();

        foreach ($users as $key => $value) {
            $contraseña = 'cucsh2024';
            $value->password = Hash::make($contraseña);
            $value->update();
        }
        echo 'FIN';
    }
    public function edit($id)
    {
        //$usuario = User::where('id', $id)->get();
        $roles = [];
        $usuario = ModelsUser::leftjoin('model_has_roles', 'model_has_roles.model_id', 'users.id')
            ->where('users.id', $id)
            //->where('model_has_roles.model_type','App\Models\User')
            ->first();
        if (Auth::user()->hasRole('admin')) {
            $roles[] = ['id' => 0, 'name' => 'Seleccione un Rol', 'selected' => ''];
            foreach (Role::orderBy('name')->get() as $rol) {
                $elemento = [
                    'id' => $rol->id,
                    'name' => $rol->name,
                    'selected' => '',
                ];
                if (isset($usuario->role_id)) {
                    if ($usuario->role_id == $rol->id) {
                        $elemento['selected'] = 'selected';
                    }
                }

                $roles[] = $elemento;
            }
            return view('admin.usuarios.edit')->with('usuario', $usuario)->with('roles', $roles);
        }
        return view('admin.usuarios.edit')->with('usuario', $usuario);
    }
    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function update_user(Request $request, $id)
    {
        $user = ModelsUser::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->email = $request['email'];
        $user->name = $request['name'];
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
                    ->route('usuario.edit', $user->id)
                    ->withErrors($validator);
            }
        }

        if ($request->hasfile('foto')) {
            $archivo = $request->file('foto');
            $nombre = $user->id . '_' . $user->name . '.jpg';
            $nombre = str_replace('/', '_', $nombre);
            $nombre = str_replace(' ', '_', $nombre);
            \Storage::disk('fotos_perfil')->put($nombre, \File::get($archivo));
            $user->foto = $nombre;
        }

        if (Auth::user()->hasRole('admin')) {
            $user->role = $request['rol'];
            $user->update();
            $user->syncRoles(); # Se borran todos los anteriores
            $user->syncRoles([$request['rol']]); # se asignan todos lo que esten en el array
            return redirect()->route('usuarios.index');
        }
        $user->update();
        Alert::success('EXITO', 'Se guardo tu información');
        return redirect()->route('home');
    }
}
