@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Acceder Registro de Proyectos de Investigación. CUCSH</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <p>Si va a registrar su proyecto por primera vez, haga clic <a
                                            href="{{ route('register') }}">aquí</a> para obtener su cuenta de acceso.</p>

                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Iniciar sesión
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn  text-white " style="background:#9124a3;"
                                            href="{{ route('password.request') }}">
                                            Cambiar la contraseña
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="card mt-5">
                    <div class="card-header">
                        Consideraciones a tomar
                    </div>
                    <div class="card-body ">
                        <p class="text-muted ">* En caso de no poder entrar intente cambiar su contraseña con el botón de
                            arriba. </p>
                        <p class="text-muted ">* Favor de utilizar su correo institucional "@académicos.udg.mx", en caso de
                            no tenerlo favor de solicitarlo en Coordinación de Tecnologías para el Aprendizaje a la ext.
                            23609.</p>
                        <p class="text-muted">* En caso de ya tener una cuenta anteriormente favor de ingresar con ella y
                            cambiar su correo en el apartado de datos generales.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
