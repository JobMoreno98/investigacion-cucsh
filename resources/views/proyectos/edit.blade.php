@extends('adminlte::page')
@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection

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
        <div class="row justify-content-center">
            <form action="{{ route('proyectos.update', $proyecto->id) }}" method="post" class="row  justify-content-center"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('proyectos.resumen')

                @include('proyectos.metodologia')
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
                        <textarea class="form-control" name="personal[]" placeholder="Asistentes internos y/o externos a la UDG" id="">{{ $proyecto->personal[3] }}</textarea>
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
                            <textarea class="form-control" name="vinculacion_cuerpos[]" placeholder="Cuerpos Académicos" id="">{{ $proyecto->vinculacion_ca ? $proyecto->vinculacion_ca : 'No aplica' }}</textarea>
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
                                        <option {{ strcmp($item->nivel, 'Estatal') == 0 ? 'selected' : '' }}
                                            value="Estatal">
                                            Estatal</option>
                                        <option {{ strcmp($item->nivel, 'Nacional') == 0 ? 'selected' : '' }}
                                            value="Nacional">
                                            Nacional</option>
                                        <option {{ strcmp($item->nivel, 'Internacional') == 0 ? 'selected' : '' }}
                                            value="Internacional">Internacional</option>
                                        <option {{ strcmp($item->nivel, 'Otro') == 0 ? 'selected' : '' }} value="Otro">
                                            Otro
                                        </option>
                                    </select>
                                    <span class="btn  btn-danger m-1 rounded-right"
                                        onclick="eliminar('{{ $item }}')">X</span>
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
                    <div class="col-sm-12 col-md-8">
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

                    <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="extenso">Proyecto en extenso</label>
                        <input accept=".pdf" class="form-control" type="file" name="extenso">
                        <label class="form-label" for="resultados">Informe de resultados</label>
                        <input accept=".pdf" class="form-control" type="file" name="resultados">
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
    @include('layouts.scripts')
    @include('sweetalert::alert')
    <script src="{{ asset('js/addSelect.js') }}"></script>
@endsection
