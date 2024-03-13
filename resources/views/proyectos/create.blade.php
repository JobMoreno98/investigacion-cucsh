@extends('layouts.app')
@section('content')
    <div class="container" onload="alerta()">
        @if ($errors->any())
            <div class="alert alert-danger ">
                @foreach ($errors->all() as $error)
                    <p class="p-0 m-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="row">
            <h3>Datos Generales</h3>
            <hr>
            <form action="{{ route('proyectos.store') }}" method="post" class="row" enctype="multipart/form-data">
                @csrf
                <div class="row p-2 m-1 justify-content-center">
                    <div class="col-sm-12 col-md-6">
                        Nombre responsable :<br> {{ $user->name }}
                    </div>
                    <div class="col-sm-12 col-md-4">
                        Correo :<br> {{ $user->email }}
                    </div>
                    <div class="col-sm-12 col-md-2">
                        Año : {{ $ciclo->anio }}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        Nombramiento :<br> {{ $user->datos->nombramiento }}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        Cuerpo Academico :<br> {{ $user->datos->cuerpo_academico }}
                    </div>

                    <div class="col-sm-12 col-md-4">
                        Reconocimiento S.N.I :<br> {{ $user->datos->reconocimiento_sni }}
                    </div>

                    <div class="col-sm-12 col-md-4">
                        Reconocimiento PROMEP :<br> {{ $user->datos->reconocimiento_promep }}
                    </div>

                    <div class="col-sm-12 col-md-4">
                        Reconocimiento PROESDE :<br> {{ $user->datos->reconocimiento_proesde }}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        División :<br> {{ $user->datos->division }}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        Departamento :<br> {{ $user->datos->departamento }}
                    </div>


                </div>

                <hr>
                <div class="row mt-3 justify-content-center align-items-center">
                    <div class="col-md-2">
                        <label class="form-label" for="tipo_registro">Tipo de registro</label>
                        <select class="form-control" name="tipo_registro" id="tipo_registro" required
                            value="{{ old('tipo_registro') }}">
                            <option selected disabled>Elegir una opción</option>
                            <option value="Proyecto nuevo">Proyecto nuevo</option>
                            <option value="Proyecto continuación">Proyecto continuación</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label" for="">Tipo proyecto</label>
                        <select class="form-control" name="tipo_proyecto" id="" required
                            value="{{ old('tipo_proyecto') }}">
                            <option selected disabled>Elegir una opción</option>
                            <option value="Investigación básica">Investigación básica</option>
                            <option value="Investigación apliacada">Investigación apliacada</option>
                            <option value="Desarrollo tecnológico y experimental">Desarrollo tecnológico y experimental
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3 p-2">
                        <label class="form-label" for="sector">Principal sector que impacta</label>
                        <select class="form-control" name="sector" id="sector" required value="{{ old('sector') }}">
                            <option selected disabled>Elegir una opción</option>
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
                            <option selected disabled>Elegir una opción</option>
                            <option value="Disciplinario">Disciplinario</option>
                            <option value="Interdisciplinario">Interdisciplinario</option>
                            <option value="Multidisciplinario">Multidisciplinario</option>
                            <option value="Transdisciplinario">Transdisciplinario</option>
                        </select>
                    </div>
                    <div class="col-md-4 p-2">
                        <label class="form-label" for="">Registro y apoyo económico en otras instituciones</label>
                        <select class="form-control" name="otras_intituciones[]" id=""
                            value="{{ old('otras_intituciones[0]') }}">
                            <option selected disabled>Elegir una opción</option>
                            <option value="No">No</option>
                            <option value="Si">Si</option>

                        </select>

                    </div>
                    <div class="col-md-12 p-2">
                        <label class="form-label" for="">En caso de recibir financiamiento especificar institución y
                            monto</label>
                        <textarea class="form-control" name="otras_intituciones[]" id="">No aplica</textarea>
                    </div>
                </div>

                <div class="row mt-3 justify-content-center align-items-center">
                    <h3>Resumen del proyecto</h3>
                    <hr class="mt-3">
                    <div class="col-md-1 text-center">
                        <label class="form-label " for="">Folio</label>
                        <input type="text" readonly name="folio" class="text-center form-control-plaintext"
                            id="staticEmail" value="{{ $folio }}" placeholder="{{ $folio }}">
                    </div>
                    <div class="col-sm-11 mb-2">
                        <label class="form-label" for="titulo">Título del Proyecto</label>
                        <input class="form-control" type="text" name="titulo" id="titulo"
                            placeholder="Título del Proyecto" required value="{{ old('titulo') }}">
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="fecha_inicio">Fecha inicio</label>
                        <input class="form-control" required type="month" name="fecha_inicio" id="fecha_inicio"
                            value="{{ old('fecha_inicio') }}">
                    </div>

                    <div class="col-sm-3">
                        <label class="form-label" for="fecha_fin">Fecha fin</label>
                        <input class="form-control" required type="month" name="fecha_fin" id="fecha_fin"
                            value="{{ old('fecha_fin') }}">
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="abstract">Resumen</label>
                        <textarea class="form-control" name="abstract" id="abstract" placeholder="Resumen"></textarea>
                    </div>

                </div>

                <div class="row mt-3 justify-content-center align-items-center">
                    <h4>Personal adscrito al proyecto</h4>
                    <span class="text-muted">* NOTA: Favor de introducir nombres completos del personal</span>
                    <hr class="mt-3">
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Estudiantes</label>
                        <textarea class="form-control" name="personal[]" placeholder="Estudiantes" id="">{{ old('personal.0') ? old('personal.0') : 'No aplica' }}</textarea>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Profesores</label>
                        <textarea class="form-control" name="personal[]" placeholder="Profesores" id="">{{ old('personal.1') ? old('personal.1') : 'No aplica' }}</textarea>
                    </div>

                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Colaboradores</label>
                        <textarea class="form-control" name="personal[]" placeholder="Colaboradores" id="">{{ old('personal.2') ? old('personal.2') : 'No aplica' }}</textarea>
                    </div>
                    <div class="col-md-6 p-2 ">
                        <label class="form-label" for="">Asistentes internos y/o externos a la UDG</label>
                        <textarea class="form-control" name="personal[]" placeholder="Asistentes internos y/o externos a la UDG"
                            id="">{{ old('personal.3') ? old('personal.3') : 'No aplica' }}</textarea>
                    </div>
                    <div class="col-md-6 p-2 ">

                        <label class="form-label text-center" for="recursos_concurrentes">Recursos concurrentes en caso de
                            aplicar al proyecto a nivel</label>
                        <select class="form-control" name="recursos_concurrentes" id="recursos_concurrentes">
                            <option value="No aplica" selected>No aplica</option>
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
                            <label class="form-label" for="">Divulgación y/o difusión de la ciencia a través de la
                                participación en:</label>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Congresos</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]" value="0" min="0" type="number"
                                        class="form-control" id="">
                                </div>
                            </div>

                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Coloquios</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]"
                                        value="{{ old('divulgacion.0') ? old('divulgacion.0') : '0' }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Conferencias</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]"
                                        value="{{ old('divulgacion.1') ? old('divulgacion.1') : '0' }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Artículos cientificos</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]"
                                        value="{{ old('divulgacion.2') ? old('divulgacion.2') : '0' }}" min="0"
                                        type="number" class="form-control" id="">
                                </div>
                            </div>
                            <div class="col-md-12 pt-1 row justify-content-around align-items-center">
                                <div class="col-md-8 ">
                                    <label class="form-label" for="">Capítulos de libros</label>
                                </div>
                                <div class="col-md-3">
                                    <input name="divulgacion[]"
                                        value="{{ old('divulgacion.3') ? old('divulgacion.3') : '0' }}" min="0"
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
                            <option disabled selected>Elegir una opción</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                        <div>
                            <label for="" class="form-label">En caso afirmativo favor de mencionar los nombres
                                de los Cuerpos Académicos con los que se vincula</label>
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
                            <select class="form-control" name="vinculacion_redes[]" id="" required>
                                <option disabled selected>Elegir una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="" class="form-label">Si aplica favor de indicar el nombre y nivel de las
                            redes académicas de las que se encuentra vinculada. <br><span class="text-muted">* NOTA: los
                                niveles son Local, Nacional, Internacional</span></label>
                        <textarea class="form-control" name="vinculacion_redes[]" placeholder="redes académicas" id="">{{ old('vinculacion_cuerpos.1') ? old('vinculacion_cuerpos.1') : 'No aplica' }}</textarea>
                    </div>

                </div>
                @include('proyectos.form-recursos')

                <div class="row mt-3 justify-content-center">
                    <h3>Archivos</h3>
                    <span class="text-muted">* NOTA 1: subir sus archivos en formato PDF</span> <br>
                    <span class="text-muted">* NOTA 2: anexar el documento en extenso con minimo los siguientes aspectos:
                        justificación, metodología, objetivos, preguntas y/o hipótesis, criterios éticos,
                        referencias, mínimo 5 cuartillas</span>
                    <hr class="mt-3">
                    <div class="col-md-4">
                        <label class="form-label" for="anexos">Proyecto en extenso</label>
                        <input accept=".pdf" class="form-control" type="file" name="anexos" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="cronograma">Cronograma</label>
                        <input accept=".pdf" class="form-control" type="file" name="cronograma" required>
                    </div>
                </div>

                <div class="row mt-3 justify-content-center">
                    <div class="col-md-3">
                        <button type="submit" class="w-100 btn btn-success">Guardar</button>
                    </div>
                </div>

            </form>
        </div>
        <script>
            $(document).ready(function() {
                alert("Solo dispones de 30 minutos para el llenado del formulario, después de este tiempo tu sesión caducará ", {
                    title: false
                });
            });
        </script>


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
    @endsection
