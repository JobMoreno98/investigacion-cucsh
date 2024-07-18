@extends('adminlte::page')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('js/tinymce/tinymce.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea', // change this value according to your HTML
            license_key: 'gpl'
        });
    </script>
@endsection
@section('content')
    <div class="container-fluid" onload="alerta()">
        @if ($errors->any())
            <div class="alert alert-danger ">
                @foreach ($errors->all() as $error)
                    <p class="p-0 m-0">{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <div class="row justify-content-center">
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
                @include('proyectos.resumen')

                @include('proyectos.metodologia')
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
                        <textarea class="form-control" name="personal[]" placeholder="Asistentes internos y/o externos a la UDG" id="">{{ old('personal.3') ? old('personal.3') : 'No aplica' }}</textarea>
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

                        <label class="form-label">Si aplica favor de indicar el nombre y nivel de las
                            redes académicas de las que se encuentra vinculada. <br><span class="text-muted">* NOTA: los
                                niveles son Local, Nacional, Internacional</span></label>
                        <div id="formulario">

                        </div>
                        <div>
                            <button type="button" id="agregar" class="clonar btn btn-secondary btn-sm">+</button>
                            <label for="agregar">Agregar</label>
                        </div>
                    </div>

                </div>

                @include('proyectos.form-recursos')
                <div class="row mt-3 justify-content-center">
                    <div class="col-md-6">
                        <h3>Archivos</h3>
                        <span class="text-muted">* NOTA 1: subir sus archivos en formato PDF.</span> <br>
                        <span class="text-muted">* NOTA 2: anexar el documento en extenso con mínimo 10 cuartillas con
                            formato APA 7.</span> <br>
                        <span class="text-muted">* NOTA 3: en caso de ser proyecto de continuidad debera entregar el
                            informe de resultados.</span> <br>
                        <span class="text-muted">* NOTA 4: favor de no incluir sus nombres en los archivos que se
                            suban.</span>
                        <hr class="mt-3">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label" for="extenso">Proyecto en extenso</label>
                        <input accept=".pdf" class="form-control" type="file" name="extenso" required>
                        <label class="form-label" for="resultados">Informe de resultados</label>
                        <input accept=".pdf" class="form-control" type="file" name="resultados" required>
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
