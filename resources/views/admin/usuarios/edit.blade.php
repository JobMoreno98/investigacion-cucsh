@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-md-5">
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    Debe de llenar los campos marcados con un asterisco (*).
                </div>
            @endif
            @if (Session::has('message'))
                <div class="col-sm-12 col-md-10">
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                </div>
            @endif

            <div class="col-sm-12 col-md-10">
                <form action="{{ route('usuario.update', $usuario->id) }}" class="row justify-content-center" method="post">
                    @csrf
                    <div class="col-sm-12  mt-2">
                        <h4>Datos del usuario</h4>
                        <hr class="mt-3 border border-dark border-1 opacity-50">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold">Nombre</label>
                        <input type="text" class="form-control-plaintext" value="{{ $usuario->name }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold">Correo</label>
                        <input type="text" class="form-control-plaintext" value="{{ $usuario->email }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold">División</label>
                        <input type="text" class="form-control-plaintext"
                            value="{{ isset($item->datos->division) ? $item->datos->division : 'Dato no registrado' }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold">Departamento</label>
                        <input type="text" class="form-control-plaintext"
                            value="{{ isset($item->datos->departamento) ? $item->datos->departamento : 'Dato no registrado' }}">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold form-label">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            <option {{ (strcmp($usuario->role, 'investigador') == 0)? 'selected' : '' }} value="investigador">
                                Investigador</option>
                            <option {{ (strcmp($usuario->role, 'evaluador') == 0) ? 'selected' : '' }} value="evaluador">
                                Evaluador
                            </option>
                            <option {{ (strcmp($usuario->role, 'admin') == 0) ? 'selected' : '' }} value="admin">Admin
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <label for="" class="fw-bold form-label">Segundo rol</label>
                        <select name="s_rol" id="s_rol" class="form-control">
                            <option {{ $usuario->s_role == null ? 'selected' : '' }} value="ninguno">Ninguno</option>
                            <option {{ strcmp($usuario->s_role, 'investigador') == 0 ? 'selected' : '' }}
                                value="investigador">
                                Investigador</option>
                            <option {{ strcmp($usuario->s_role, 'evaluador') == 0 ? 'selected' : '' }} value="evaluador">
                                Evaluador
                            </option>
                            <option {{ strcmp($usuario->s_role, 'admin') == 0 ? 'selected' : '' }} value="admin">Admin
                            </option>
                        </select>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-3 mt-2">
                            <button type="submit" class="btn btn-outline-success w-100">Guardar</button>
                        </div>
                    </div>


                </form>
                <div class="col-sm-12 mt-3">
                    <h4>Cambio de contraseña</h4>
                    <hr class="mt-3 border border-dark border-1 opacity-50">
                    <a href=""></a>
                </div>
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-4 mt-2">
                        <a href="{{ route('password.resetear', $usuario->id) }}" class="btn btn-warning w-100">Click
                            aquí para resetear la contraseña</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
