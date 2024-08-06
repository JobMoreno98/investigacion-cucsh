@extends('adminlte::page')
@section('title', 'Editar Perfil')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')
    <style>
        #foto-perfil {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Actualizar') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update-user', $usuario->id) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="d-flex justify-content-center my-2">
                                @php
                                    if (isset($usuario->foto) && strcmp('', $usuario->foto) != 0) {
                                        $url = asset('storage/fotos_perfil/' . $usuario->foto);
                                    } else {
                                        $url = asset('images/user-logo.png');
                                    }
                                @endphp
                                <img id="foto-perfil" src="{{ $url }}" alt="">
                            </div>
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ $usuario->name }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $usuario->email }}" required autocomplete="email">
                                </div>
                            </div>
                            @if (Auth::user()->hasRole('admin'))
                                <div class="form-group row">
                                    <label for="rol"
                                        class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control" id="rol" name="rol">
                                            @foreach ($roles as $rol)
                                                <option {{ $rol['selected'] }}>{{ $rol['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="">Foto de perfil</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="file" name="foto" accept=".jpg,.jpeg,.png"
                                        id="">
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Actualizar') }}
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @include('layouts.scripts')
@endsection
