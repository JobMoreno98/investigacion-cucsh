@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <h3>Datos Generales</h3>
            <hr>
            <form action="{{ route('proyectos.update', $proyecto->id) }}" method="post" class="row"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row p-2 m-1 justify-content-center">
                    <div class="col-sm-12 col-md-6">
                        Nombre responsable :<br> {{ $proyecto->user->name }}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        Correo :<br> {{ $proyecto->user->email }}
                    </div>
                    <div class="col-sm-12 col-md-2">
                        Año : {{ $proyecto->ciclo->anio }}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        Nombramiento :<br> {{ $proyecto->user->datos->nombramiento }}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        Cuerpo Academico :<br> {{ $proyecto->user->datos->cuerpo_academico }}
                    </div>

                    <div class="col-sm-12 col-md-4">
                        Reconocimiento S.N.I :<br> {{ $proyecto->user->datos->reconocimiento_sni }}
                    </div>

                    <div class="col-sm-12 col-md-4">
                        Reconocimiento PROMEP :<br> {{ $proyecto->user->datos->reconocimiento_promep }}
                    </div>

                    <div class="col-sm-12 col-md-4">
                        Reconocimiento PROESDE :<br> {{ $proyecto->user->datos->reconocimiento_proesde }}
                    </div>

                    <div class="col-sm-12 col-md-6">
                        Departamento :<br> {{ $proyecto->user->datos->departamento }}
                    </div>

                    <div class="col-sm-12 col-md-6">
                        División :<br> {{ $proyecto->user->datos->division }}
                    </div>
                </div>

                <hr>
                <div class="row mt-3 justify-content-center align-items-center">
                    <div class="col-sm-3">
                        <label class="form-label" for="tipo_registro">Tipo de registro</label>
                        <select class="form-control" name="tipo_registro" id="tipo_registro">
                            <option style="padding: 5px;" value="{{ $proyecto->tipo_registro }}" selected>
                                {{ $proyecto->tipo_registro }}</option>

                            <option disabled>Elegir una opción</option>
                            <option value="Proyecto nuevo">Proyecto nuevo</option>
                            <option value="Proyeto continuación">Proyecto continuación</option>
                            <option value="Proyecto cuerpo académico">Proyecto cuerpo académico</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" for="">Tipo proyecto</label>
                        <select class="form-control" name="tipo_proyecto" id="tipo_proyecto">
                            <option value="{{ $proyecto->tipo_proyecto }}" selected>{{ $proyecto->tipo_proyecto }}
                            </option>

                            <option disabled>Elegir una opción</option>
                            <option value="Básica">Básica</option>
                            <option value="Apliacada">Apliacada</option>
                            <option value="Desarrollo tecnológico y experimental">Desarrollo tecnológico y experimental
                            </option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label" for="">Principal sector que impacta</label>
                        <select class="form-control" name="sector" id="sector">
                            <option value="{{ $proyecto->sector }}" selected>{{ $proyecto->sector }}</option>
                            <option disabled>Elegir una opción</option>
                            <option value="Social">Social</option>
                            <option value="Público">Público</option>
                            <option value="Privado">Privado</option>
                        </select>
                    </div>
                    <div class="col-md-3 p-2">
                        <label class="form-label" for="sector">Enfoque del proyecto <button type="button" class="btn p-0"
                                data-bs-toggle="modal" data-bs-target="#info_enfoque">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-question-circle-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.496 6.033h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286a.237.237 0 0 0 .241.247zm2.325 6.443c.61 0 1.029-.394 1.029-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94 0 .533.425.927 1.01.927z" />
                                </svg>
                            </button></label>
                        <select class="form-control" name="enfoque" id="enfoque" required value="{{ old('enfoque') }}">
                            <option value="{{ $proyecto->enfoque }}" selected>{{ $proyecto->enfoque }}</option>
                            <option disabled>Elegir una opción</option>
                            <option value="Disciplinario">Disciplinario</option>
                            <option value="Interdisciplinario">Interdisciplinario</option>
                            <option value="Multidisciplinario">Multidisciplinario</option>
                            <option value="Transdisciplinario">Transdisciplinario</option>
                        </select>
                    </div>
                    <div class="col-md-4 p-2">
                        <label class="form-label" for="">Registro y apoyo económico en otras instituciones</label>
                        <select class="form-control" name="otras_intituciones[]" id="" value="">
                            <option disabled>Elegir una opción</option>
                            <option {{ strcmp($proyecto->otras_instituciones, 'No aplica') == 0 ? 'selected' : '' }}
                                value="No aplica">No aplica</option>
                            <option {{ strcmp($proyecto->otras_instituciones, 'No aplica') != 0 ? 'selected' : '' }}
                                value="Si">Si</option>

                        </select>

                    </div>
                    <div class="col-md-12 p-2">
                        <label class="form-label" for="">En caso de recibir financiamiento especificar institución y
                            monto</label>
                        <textarea class="form-control" name="otras_intituciones[]" id="">{{ strcmp($proyecto->otras_instituciones, 'No aplica') != 0 ? $proyecto->otras_instituciones : 'No aplica' }}</textarea>
                    </div>
                </div>

                <div class="row mt-3 justify-content-center">
                    <h2>Resumen del proyecto</h2>
                    <hr class="mt-3">
                    <div class="col-md-1">
                        <label class="form-label" for="">Folio</label>
                        <input type="text" readonly name="folio" class="form-control-plaintext" id="staticEmail"
                            value="{{ $proyecto->folio }}" placeholder="{{ $proyecto->folio }}">
                    </div>
                    <div class="col-sm-11 mb-2">
                        <label class="form-label" for="titulo">Título del Proyecto</label>
                        <input class="form-control" type="text" name="titulo" id="titulo"
                            value="{{ $proyecto->titulo_proyecto }}">
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="fecha_inicio">Fecha inicio</label>
                        <input class="form-control" required type="month" name="fecha_inicio" id="fecha_inicio"
                            value="{{ $proyecto->fecha_inicio }}">
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="fecha_fin">Fecha fin</label>
                        <input class="form-control" required type="month" name="fecha_fin" id="fecha_fin"
                            value="{{ $proyecto->fecha_fin }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="abstract">Resumen</label>
                        <textarea style="max-height: 200px;" class="form-control" name="abstract" id="editor">{{ $proyecto->abstract }}</textarea>
                    </div>

                </div>

                <div class="row mt-3 justify-content-center">
                    <h3>Personal adscrito al proyecto</h3>
                    <span class="text-muted">* NOTA: Favor de introducir nombres completos del personal</span>
                    <hr class="mt-3">
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Estudiantes</label>
                        <textarea class="form-control" name="personal[]" placeholder="Estudiantes" id="">{{ $proyecto->personal[0] }}</textarea>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Profesores</label>
                        <textarea class="form-control" name="personal[]" placeholder="Colaboradores" id="">{{ $proyecto->personal[1] }}</textarea>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Colaboradores</label>
                        <textarea class="form-control" name="personal[]" placeholder="Colaboradores" id="">{{ $proyecto->personal[2] }}</textarea>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Asistentes internos y/o externos a la UDG</label>
                        <textarea class="form-control" name="personal[]" placeholder="Asistentes internos y/o externos a la UDG"
                            id="">{{ $proyecto->personal[3] }}</textarea>
                    </div>

                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Recursos concurrentes en caso de aplciar al proyecto a
                            nivel</label>
                        <select class="form-control" name="recursos_concurrentes" id="recursos_concurrentes">
                            <option value="{{ $proyecto->recursos_concurrentes }}" selected>
                                {{ $proyecto->recursos_concurrentes }}</option>

                            <option disabled>Elegir una opción</option>
                            <option value="No aplica">No aplica</option>
                            <option value="Estatal">Estatal</option>
                            <option value="Nacional">Nacional</option>
                            <option value="Internacional">Internacional</option>
                        </select>
                    </div>
                </div>


                <div class="row mt-3 justify-content-center align-items-center">
                    <h4>Actividades</h4>
                    <hr class="mt-3 border border-dark border-1 opacity-50">
                    <div class="col-md-6 p-2 ">
                        <div class="pb-3 mb-3">
                            <label class="form-label" for="">Divulgación y/o difución de la ciencia a través de la
                                participación en:</label>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Congresos</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]" value="{{ $proyecto->divulgacion[0] }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>

                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Coloquios</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]" value="{{ $proyecto->divulgacion[1] }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Conferecnias</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]" value="{{ $proyecto->divulgacion[2] }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Articulos cientificos</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]" value="{{ $proyecto->divulgacion[3] }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Capitulos de libros</label>
                                </div>

                                <div class="col-md-3">
                                    <input name="divulgacion[]" value="{{ $proyecto->divulgacion[4] }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Otro</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="otro" value="0" min="0" type="number"
                                        class="form-control" id="">
                                </div>
                            </div>
                            <div>
                                <label for="" class="form-label">En caso de ser Otro llenar este campo</label>
                                <input class="form-control" type="text" name="otro" placeholder="Otro"
                                    id="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Vinculación con Cuerpos Académicos:</label>
                        <select class="form-control" name="vinculacion_cuerpos[]" id="">
                            <option disabled>Elegir una opción</option>
                            <option value="Si">Si</option>
                            <option {{ strcmp($proyecto->vinculacion_redes, 'No') == 0 ? 'selected' : '' }}
                                value="No">No
                            </option>
                        </select>
                        <div>
                            <label for="" class="form-label">En caso afirmativo favor de mencionar los nombres de
                                los Cuerpos Académicos con los que se vincula</label>
                            <textarea class="form-control" name="vinculacion_cuerpos[]" placeholder="Cuerpos Académicos" id="">{{ old('vinculacion_cuerpos.1') ? old('vinculacion_cuerpos.1') : 'No aplica' }}</textarea>
                        </div>
                    </div>
                </div>
                {{-- Redes de Vinculación --}}
                <div class="row align-items-center">
                    <h4>Redes de vinculación</h4>
                    <hr class="border border-dark border-1 opacity-50 mt-3">
                    <div class="col-md-6 col-sm-12">
                        <div class="pt-3 mt-3 ">
                            <label class="form-label" for="">A través de su proyecto se encuentra vinculado con
                                redes académicas:</label>
                            <select class="form-control" name="vinculacion_redes[]" id="">
                                <option disabled>Elegir una opción</option>
                                <option value="Si">Si</option>
                                <option value="No"
                                    {{ strcmp($proyecto->vinculacion_redes, 'No aplica') == 0 ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="" class="form-label">Si aplicará favor de indicar el nombre y nivel de las
                            redes académicas de las que se encuentra vinculada <br><span class="text-muted">* NOTA: los
                                niveles son Local, Nacional, Internacional</span> </label>

                        <div id="formulario">
                            @foreach ($redes as $item)
                                <div class="input-group d-flex flex-wrap" id="{{ $item }}">
                                    <input type="text" class="form-control col-md-3 m-1 rounded" name="r_nombre[]"
                                        value="{{ $item->nombre }}">
                                    <select class="form-control col-md-3 m-1 rounded" name="r_tipo[]" id="">
                                        <option {{ strcmp($item->nivel, 'Estatal') == 0 ? 'selected' : '' }} value="Estatal">
                                            Estatal</option>
                                        <option {{ strcmp($item->nivel, 'Nacional') == 0 ? 'selected' : '' }} value="Nacional">
                                            Nacional</option>
                                        <option {{ strcmp($item->nivel, 'Internacional') == 0 ? 'selected' : '' }}
                                            value="Internacional">Internacional</option>
                                        <option {{ strcmp($item->nivel, 'Otro') == 0 ? 'selected' : '' }} value="Otro">Otro
                                        </option>
                                    </select>
                                    <span class="btn  btn-danger m-1 rounded-right" onclick="eliminar('{{ $item }}')">X</span>
                                    <br>
                                </div>
                            @endforeach

                        </div>
                        <div>
                            <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
                            <label for="agregar">Agregar</label>
                        </div>
                    </div>

                </div>
                @include('proyectos.form-recursos')
                <div class="row mt-3 justify-content-center">
                    <h3>Archivos</h3>
                    <span class="text-muted">* NOTA 1: subir sus archivos en formato PDF</span> <br>
                    <span class="text-muted">* NOTA 2: los archivos solamente se suben una vez, en caso de realizar
                        algun cambio debe de llevar el mismo nombre que el anteriror</span>
                    <hr class="mt-3">
                    <div class="col-md-4">
                        <label class="form-label" for="anexos">Proyecto en extenso</label>
                        <input accept=".pdf" class="form-control" type="file" name="anexos">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="cronograma">Cronograma</label>
                        <input accept=".pdf" class="form-control" type="file" name="cronograma">
                    </div>

                </div>

                <div class="row mt-3 justify-content-center">
                    <div class="col-md-3">
                        <button type="submit" class="w-100 btn btn-success">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
        <!--   Modal enfoque del proyecto   -->
        <div class="modal fade" id="info_enfoque" tabindex="-1" aria-labelledby="info_enfoque" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="info_enfoque">¿Como saber qué tipo de enfoque tiene
                            mi proyecto
                            de investigación?</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4>Seleccione el enfoque del proyecto de investigación <br></h4>
                        <dd class="ps-3">
                            a. Proyectos Disciplinarios: responden a problemas y oportunidades a través de la
                            generación de nuevo conocimiento desde una sola disciplina.
                        </dd>
                        <dd class="ps-3"> b. Proyecto Interdisciplinario: proyectos de investigación que abarcan aspectos
                            de
                            varias disciplinas, pero en un aspecto puntual.


                        </dd>
                        <dd class="ps-3">c. Proyecto Multidisciplinario: proyectos de investigación que involucran el
                            conocimiento varias disciplinas cada una aportando desde su espacio al tema en
                            cuestión.


                        </dd>
                        <dd class="ps-3">d. Proyecto Transversal: connota una estrategia de investigación que atraviesa
                            límites disciplinarios para crear un enfoque holístico.</dd>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('sweetalert::alert')
    <script src="{{ asset('js/addSelect.js') }}"></script>
@endsection
