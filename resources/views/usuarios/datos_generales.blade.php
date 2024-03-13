@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row ">
@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <h3>Datos Generales</h3>
            <hr>
            <form action="{{ route('usuarios.update', Auth::user()->id) }}" method="post" class="row justify-content-center">
                @csrf
                @method('PUT')
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="">Nombre</label>
                    <input class="form-control" type="text" name="name" id="" value="{{ $user->name }}">
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="">Correo</label>
                    <input class="form-control" type="text" name="email" id="" value="{{ $user->email }}">
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="">Nombramiento</label>
                    <input class="form-control" type="text" name="nombramiento" id=""
                        value="{{ $user->datos != null ? $user->datos->nombramiento : '' }}">
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="">Cuerpo Academico</label>
                    <input class="form-control" type="text" name="cuerpo_academico" id=""
                        value="{{ $user->datos != null ? $user->datos->cuerpo_academico : '' }}">
                </div>

                <div class="col-sm-12 col-md-4">
                    <label for="" class="form-label">Reconocimiento S.N.I</label>
                    <select name="reconocimiento_sni" id="" class="form-control">
                        <option disabled selected>Elegir</option>
                        <option value="No"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_sni, 'No') == 0 ? 'selected' : '') : '' }}>
                            No
                        </option>
                        <option value="Nivel 1"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_sni, 'Nivel 1') == 0 ? 'selected' : '') : '' }}>Nivel 1
                        </option>
                        <option value="Nivel 2"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_sni, 'Nivel 2') == 0 ? 'selected' : '') : '' }}>Nivel 2
                        </option>
                        <option value="Nivel 3"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_sni, 'Nivel 3') == 0 ? 'selected' : '') : '' }}>Nivel 3
                        </option>
                        <option value="Candidato"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_sni, 'Candidato') == 0 ? 'selected' : '') : '' }}>Candidato
                        </option>
                        <option value="Emérito"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_sni, 'Emérito') == 0 ? 'selected' : '') : '' }}>Emérito
                        </option>
                    </select>
                </div>

                <div class="col-sm-12 col-md-4">
                    <label for="" class="form-label">Reconocimiento PROMEP</label>
                    <select name="reconocimiento_promep" id="" class="form-control">
                        <option disabled selected>Elegir</option>
                        <option value="Si"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_promep, 'Si') == 0 ? 'selected' : '') : '' }}>Si</option>
                        <option value="No"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_promep, 'No') == 0 ? 'selected' : '') : '' }}>No</option>
                    </select>
                </div>

                <div class="col-sm-12 col-md-4">
                    <label for="" class="form-label">Reconocimiento PROESDE</label>
                    <select name="reconocimiento_proesde" id="" class="form-control">
                        <option disabled selected>Elegir</option>
                        <option value="Si"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_proesde, 'Si') == 0 ? 'selected' : '') : '' }}>Si</option>
                        <option value="No"
                            {{ $user->datos != null ? (strcmp($user->datos->reconocimiento_proesde, 'No') == 0 ? 'selected' : '') : '' }}>No</option>
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="departamento">Departamento</label>
                    <select class="form-control" id="departamento" name="departamento">
                        <option value="{{ $user->datos != null ? $user->datos->departamento: ''}}" >{{ $user->datos != null ? $user->datos->departamento: ''}}
                        </option>
                        <option disabled >Elegir</option>
                        <option value="Departamento de Lenguas Modernas">Departamento de Lenguas Modernas</option>
                        <option value="Departamento de Filosofía">Departamento de Filosofía</option>
                        <option value="Departamento de Geografía y Ordenación Territorial">Departamento de Geografía y
                            Ordenación Territorial</option>
                        <option value="Departamento de Historia">Departamento de Historia</option>
                        <option value="Departamento de Letras">Departamento de Letras</option>
                        <option value="Departamento de Derecho Público">Departamento de Derecho Público</option>
                        <option value="Departamento de Derecho Privado">Departamento de Derecho Privado</option>
                        <option value="Departamento de Derecho Social">Departamento de Derecho Social</option>
                        <option value="Departamento de Disciplinas sobre el Derecho">Departamento de Disciplinas sobre el
                            Derecho</option>
                        <option value="Departamento de Estudios en Lenguas Indígenas">Departamento de Estudios en Lenguas
                            Indígenas</option>
                        <option value="Departamento de Estudios de la Comunicación Social">Departamento de Estudios de la
                            Comunicación Social</option>
                        <option value="Departamento de Estudios Literarios">Departamento de Estudios Literarios</option>
                        <option value="Departamento de Estudios Mesoamericanos y Mexicanos">Departamento de Estudios
                            Mesoamericanos y Mexicanos</option>
                        <option value="Departamento de Sociología">Departamento de Sociología</option>
                        <option value="Departamento de Estudios Políticos">Departamento de Estudios Políticos</option>
                        <option value="Departamento de Trabajo Social">Departamento de Trabajo Social</option>
                        <option value="Departamento de Estudios  Internacionales">Departamento de Estudios 
                            Internacionales</option>
                        <option value="Departamento de Desarrollo Social">Departamento de Desarrollo Social</option>
                        <option value="Departamento de Estudios en Educación">Departamento de Estudios en Educación</option>
                        <option value="Departamento de Estudios Ibéricos y Latinoamericanos">Departamento de Estudios
                            Ibéricos y Latinoamericanos</option>
                        <option value="Departamento de Estudios sobre Movimientos Sociales">Departamento de Estudios sobre
                            Movimientos Sociales</option>
                        <option value="Departamento de Estudios Socio Urbanos">Departamento de Estudios Socio Urbanos
                        </option>
                        <option value="Departamento de Estudios del Pacífico">Departamento de Estudios del Pacífico</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="division">División</label>
                    <select class="form-control" id="division" name="division">
                        <option selected value="{{ $user->datos != null ? $user->datos->division: '' }}">{{ $user->datos != null ? $user->datos->division: '' }}</option>
                        <option disabled >Elegir</option>
                        <option value="División de Estudios Históricos y Humanos">División de Estudios Históricos y Humanos
                        </option>
                        <option value="División de Estudios Jurídicos">División de Estudios Jurídicos</option>
                        <option value="División de Estudios de la Cultura">División de Estudios de la Cultura</option>
                        <option value="División de Estudios Políticos y Sociales">División de Estudios Políticos y Sociales
                        </option>
                        <option value="División de Estudios de Estado y Sociedad">División de Estudios de Estado y Sociedad
                        </option>
                    </select>
                </div>


                <div class="col-sm-12 mt-3">
                    <h4>Cambio de contraseña</h4>
                    <hr class="mt-3 border border-dark border-1 opacity-50">
                    <a href=""></a>
                </div>

                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="">Contraseña nueva</label>
                    <input class="form-control" type="password" name="password" id="" >
                    @error('password')
                        <small>{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="">Confirmar contraseña</label>
                    <input class="form-control" type="password" name="password_confirmation" id="">
                    @error('password_confirmation')
                        <small>{{ $message }}</small>
                    @enderror
                </div>


                
                <div class=" col-sm-12 col-md-2 mt-2">
                    <button type="submit" class="btn btn-success w-100">Guardar</button>
                </div>

            </form>
        </div>
    @endsection
