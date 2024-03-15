@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12">
                <div class="card w-100  shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title text-center border-bottom mb-3 pb-3">Folio:
                            {{ $proyecto->ciclo->anio . '/' . $proyecto->folio }}
                            <br /> Título: {{ $proyecto->titulo_proyecto }}
                        </h4>
                        <div class="row justify-content-center">
                            <div class=" my-1 col-sm-6 col-md-3 col-lg-2 text-center">
                                <p class="card-text"><span class="fw-bold">Fecha inicio</span> <br>
                                    {{ $proyecto->fecha_inicio }}</p>
                            </div>
                            <div class=" my-1 col-sm-6 col-md-3 col-lg-2 text-center">
                                <p class="card-text"><span class="fw-bold">Fecha fin</span> <br> {{ $proyecto->fecha_fin }}
                                </p>
                            </div>
                            <div class=" my-1 col-sm-6 col-md-3 col-lg-2 text-center">
                                <p class="card-text"><span class="fw-bold"> Tipo de registro</span><br>
                                    {{ $proyecto->tipo_registro }}</p>
                            </div>
                            <div class=" my-1 col-sm-6 col-md-3 col-lg-2 text-center">
                                <p class="card-text"><span class="fw-bold"> Tipo proyecto</span><br>
                                    {{ $proyecto->tipo_proyecto }}</p>
                            </div>
                            <div class=" my-1 col-sm-6 col-md-3 col-lg-2 text-center">
                                <p class="card-text"><span class="fw-bold">Sector que impacta</span> <br>
                                    {{ $proyecto->sector }}</p>
                            </div>

                            <h4 class="text-center mt-3"><span
                                    class="border-1 border-dark border-bottom px-2 ">Resumen</span>
                            </h4>
                            <div class="col-sm-12 col-md-10 text-start">
                                {!! $proyecto->abstract !!}
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <h4 class="text-center mt-3">
                                <span class="border-1 border-dark border-bottom px-2 ">Metodología</span>
                            </h4>
                            <div class="col-sm-10 ">

                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                Metodologías
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $metodologias->metodologia !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                Objetívos
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $metodologias->objetivos !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Hipotesís
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $metodologias->hipotesis !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                Criterios Éticos
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $metodologias->criterios_eticos !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <h4 class="text-center mt-3"><span class=" px-2 ">Apoyo otras
                                instituciones</span>
                        </h4>
                        <div class="row text-center justify-content-center">
                            {!! $proyecto->otras_instituciones !!}
                        </div>

                        <div class="row text-center justify-content-center ">
                            <h4 class="mt-4 pt-4"><span class=" px-2">Personal adscrito al
                                    proyecto</span>
                            </h4>
                            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                                <h6><span class="border-2  border-bottom px-2">Estudiantes</span> </h6>
                                {!! $proyecto->personal[0] !!}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                                <h6><span class="border-2  border-bottom px-2">Profesores</span> </h6>
                                {!! $proyecto->personal[1] !!}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                                <h6><span class="border-2  border-bottom px-2">Colaboradores</span> </h6>
                                {!! $proyecto->personal[2] !!}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2 pt-2">
                                <h6><span class="border-2  border-bottom px-2">Asistentes externos</span></h6>
                                {!! $proyecto->personal[3] !!}
                            </div>
                            <div class="col-md-6 mt-2 pt-2">
                                <h6><span class="border-2  border-bottom px-2">Recursos concurrentes</span></h6>
                                {{ $proyecto->recursos_concurrentes }}
                            </div>
                        </div>
                    </div>


                    <div class="row text-center ">
                        <h4 class="mt-4 pt-4"><span class="border-1 border-dark border-bottom px-2">Actividades de
                                divulgación</span>
                        </h4>
                        <div class="col-md-6 mt-2 pt-2">
                            <h6><span class="border-2  border-bottom px-2">Divulgación y/o difución de la ciencia a través
                                    de la participación</span></h6>
                            <ul class="list-group list-group-flush px-5">
                                <li class="list-group-item">Congresos - {{ $proyecto->divulgacion[0] }}</li>
                                <li class="list-group-item">Coloquios - {{ $proyecto->divulgacion[1] }}</li>
                                <li class="list-group-item">Conferecnias - {{ $proyecto->divulgacion[2] }}</li>
                                <li class="list-group-item">Articulos cientificos - {{ $proyecto->divulgacion[3] }}</li>
                                <li class="list-group-item">Capitulos de libros - {{ $proyecto->divulgacion[4] }}</li>
                                @if (isset($proyecto->otros))
                                    <li class="list-group-item">Otro - {{ $proyecto->otros }}</li>
                                @endif
                            </ul>

                        </div>

                        <div class="col-md-6 mt-2 pt-2">
                            <h6><span class="border-2  border-bottom px-2">Vinculación con Cuerpos Académicos</span></h6>
                            {!! $proyecto->vinculacion_ca !!}
                        </div>
                    </div>


                    <div class="row text-center justify-content-center">
                        <h4 class="mt-4 pt-4"><span class="border-1 border-dark border-bottom px-2">Redes de
                                vinculación</span>
                        </h4>
                        <div class="col-md-6 mt-2 pt-2">
                            @foreach ($redes as $item)
                                <p>
                                    <span>Nombre: </span> {{ $item->nombre }} <br>
                                    <span>Nivel: </span> {{ $item->nivel }}
                                </p>
                            @endforeach


                        </div>
                    </div>

                    <div class="row  mx-5">
                        <h4 class="mt-4 pt-4 text-center"><span
                                class="border-1 border-dark border-bottom px-2">Recursos</span>
                        </h4>


                        <div class="col-md-5 mt-2 pt-2 ">
                            <table class="table h-100 table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Recurso
                                        </th>
                                        <th>
                                            Monto solicitado
                                        </th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>3711 Transporte aéreo nacional</td>
                                    <td>{{ $proyecto->recursos->p_01 }}</td>
                                </tr>
                                <tr>
                                    <td>3721 Transporte terrestre nacional</td>
                                    <td>{{ $proyecto->recursos->p_02 }}</td>
                                </tr>
                                <tr>
                                    <td>3722 Casetas</td>
                                    <td> {{ $proyecto->recursos->p_03 }}</td>
                                </tr>
                                <tr>
                                    <td>3751 Hospedaje nacional </td>
                                    <td>{{ $proyecto->recursos->p_04 }}</td>
                                </tr>

                            </table>
                        </div>

                        <div class="col-md-7 mt-2 pt-2 ">
                            <table class="table h-100 table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Recurso
                                        </th>
                                        <th>
                                            Monto solicitado
                                        </th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td>3753 Alimentación nacional </td>
                                    <td>{{ $proyecto->recursos->p_05 }}</td>
                                </tr>
                                <tr>
                                    <td>2611 Combustible </td>
                                    <td>{{ $proyecto->recursos->p_06 }}</td>
                                </tr>
                                <tr>
                                    <td>2111 Papelería</td>
                                    <td> {{ $proyecto->recursos->p_07 }}</td>
                                </tr>
                                <tr>
                                    <td>2141 Tóner y memoria usb (para el caso de las memorias USB con precio unitario menor
                                        a $4,211.83 pesos) </td>
                                    <td>{{ $proyecto->recursos->p_08 }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row justify-content-center text-center">
                            <div class="col-md-4">
                                <h5 class="mt-4 pt-4 text-center"><span
                                        class="border-1 border-dark border-bottom px-2">Total del monto solicitado</span>
                                </h5>
                                <span>
                                    {{ $proyecto->monto_total }}
                                </span>

                            </div>
                        </div>
                        <div class="col-sm-12 text-center pt-2 mt-2 ">
                            <h5 class="mt-4 pt-4 text-center"><span
                                    class="border-1 border-dark border-bottom px-2">Justificacion del recurso</span>
                            </h5>

                            {!! $proyecto->recursos->justificacion !!}
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <h4 class="mt-4 pt-4 text-center"><span
                                class="border-1 border-dark border-bottom px-2">Archivos</span>
                        </h4>
                        <div class="col-auto">
                            <a target="_blank"class="btn border-2  border-bottom px-2"
                                href="{{ asset('/storage/anexos/' . $proyecto->extenso) }}">Proyecto en extenso</a>
                        </div>

                        @if (strcmp($proyecto->avances, '') != 0 && strcmp($proyecto->tipo_registro, 'Proyecto continuación') == 0)
                            <div class="col-auto">
                                <a target="_blank" class="btn border-2  border-bottom px-2"
                                    href="{{ asset('/storage/continuacion/' . $proyecto->avances) }}">Informe de avances
                                    del
                                    proyecto</a>
                            </div>
                        @endif
                        <div class="col-auto"> <a target="_blank" class="btn border-2  border-bottom px-2"
                                href="{{ url('/storage/cronogramas/' . $proyecto->cronograma) }}">Cronograma</a>
                        </div>

                    </div>
                    @if ($proyecto->user_id == Auth::user()->id && $proyecto->definitivo == 0)
                        <div class="row justify-content-center p-2 m-2">
                            <div class="col-md-2">
                                <a class="btn btn-outline-success w-100"
                                    href="{{ route('proyectos.edit', $proyecto->id) }}">Editar</a>
                            </div>
                            <div class="col-md-2 ps-3  border-start">
                                <a class="btn btn-outline-danger w-100"
                                    href="{{ route('proyectos.delete', $proyecto->id) }}">Eliminar</a>
                            </div>

                        </div>
                        @if (strcmp($proyecto->tipo_registro, 'Proyecto continuación') == 0)
                            <form action="{{ route('avances-proyecto', $proyecto->id) }}" method="post"
                                class="row justify-content-center align-items-center p-2 m-2"
                                enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="col-sm-12 col-md-2 text-end">
                                    <label class="form-label" for="">Informe de avances del proyecto</label>
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <input accept=".pdf" type="file" class="form-control" name="avances"
                                        id="avances">
                                    <input type="text" class="d-none" value="{{ $proyecto->folio }}"
                                        class="form-control" name="folio" id="avances">
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <button class="btn btn-success" type="submit">Subir archivo</button>
                                </div>
                            </form>
                        @endif
                    @endif

                    <div class="row justify-content-center p-2 m-2">
                        <div class="col-md-2">
                            <a class="btn btn-primary text-center w-100"
                                href="{{ route('imprimirProyecto', $proyecto->id) }}">Imprimir proyecto</a>
                        </div>
                        @if (Auth::user()->role == 'admin' || Auth::user()->s_role == 'admin')
                            <div class="col-md-2 ps-3  border-start">
                                <a class="btn btn-outline-danger w-100"
                                    href="{{ route('proyectos.delete', $proyecto->id) }}">Eliminar</a>
                            </div>
                            @if ($proyecto->definitivo == 0)
                                <div class="col-md-2 ps-3  border-start">
                                    <a href="{{ route('proyectos.definitivo', $proyecto->id) }}"
                                        class="btn btn-outline-warning w-100">Enviar definitivo</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
