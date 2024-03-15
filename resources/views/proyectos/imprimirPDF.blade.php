<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $proyecto->ciclo->anio }}/{{ $proyecto->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        #footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        }

        @page {
            margin-top: 15px;
            margin-bottom: 0px;
        }

        .pie {
            font-size: 10px;
            text-align: center;
            border-top: grey 1px solid;
            margin-top: 15px;
            padding-top: 10px;
        }

        #footer .page:after {
            content: counter(page, decimal);
        }
    </style>
</head>

<body>
    <footer id="footer">
        <p class="pie"><span class="page">Página </span></p>
    </footer>
    <main>
        <div >
            <div >
                <div >
                    <div >
                        <div >
                            <div >
                                <p class="text-center"><img class="img-responsive" src="images/logo.jpg" height="100px">
                                </p>
                            </div>
                        </div>

                        <h4 class="card-title text-center border-bottom mb-3 pb-3">Folio:
                            {{ $proyecto->ciclo->anio }}/{{ $proyecto->id }}
                            <br /> Título: {{ $proyecto->titulo_proyecto }}
                        </h4>
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha inicio</th>
                                    <th class="text-center">Fecha fin</th>
                                    <th class="text-center">Tipo de registro</th>
                                    <th class="text-center">Tipo proyecto</th>
                                    <th class="text-center">Sector que impacta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $proyecto->fecha_inicio }}</td>
                                    <td class="text-center">{{ $proyecto->fecha_fin }}</td>
                                    <td class="text-center">{{ $proyecto->tipo_registro }}</td>
                                    <td class="text-center">{{ $proyecto->tipo_proyecto }}</td>
                                    <td class="text-center">{{ $proyecto->sector }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 class="text-center mt-3"><span
                                class="border-1 border-dark border-bottom px-2 ">Resumen</span>
                        </h4>
                        <div class="col-sm-12 col-md-9 text-start">
                            {!! $proyecto->abstract !!}
                        </div>

                        <h4 class="text-center mt-3"><span
                                class="border-1 border-dark border-bottom px-2 ">Metodología</span>
                        </h4>
                        <div class="col-sm-12 col-md-9 text-start">
                            {!! $metodologias->metodologia !!}
                        </div>

                        <h4 class="text-center mt-3"><span
                                class="border-1 border-dark border-bottom px-2 ">Objetivos</span>
                        </h4>
                        <div class="col-sm-12 col-md-9 text-start">
                            {!! $metodologias->objetivos !!}
                        </div>

                        <h4 class="text-center mt-3"><span class="border-1 border-dark border-bottom px-2 ">Preguntas o
                                Hipotesis</span>
                        </h4>
                        <div class="col-sm-12 col-md-9 text-start">
                            {!! $metodologias->hipotesis !!}
                        </div>

                        <h4 class="text-center mt-3"><span class="border-1 border-dark border-bottom px-2 ">Criterios
                                Éticos</span>
                        </h4>
                        <div class="col-sm-12 col-md-9 text-start">
                            {!! $metodologias->criterios_eticos !!}
                        </div>


                        <h4 class="text-center mt-3"><span class="border-1 border-dark border-bottom px-2 ">Apoyo otras
                                instituciones</span>
                        </h4>
                        <div class="row text-center justify-content-center">
                            {!! $proyecto->otras_instituciones !!}
                        </div>


                        <div class="row text-center justify-content-center ">
                            <h4 class="mt-4 pt-4"><span class="border-1 border-dark border-bottom px-2">Personal
                                    adscrito al
                                    proyecto</span>
                            </h4>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td class="text-center">Estudiantes<br />{!! $proyecto->personal[0] !!}
                                        </td>
                                        <td class="text-center">Profesores <br>{!! $proyecto->personal[1] !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Colaboradores <br />{!! $proyecto->personal[2] !!}</td>
                                        <td class="text-center">Asistentes externos <br>{!! $proyecto->personal[3] !!}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                            <h6><span class="border-2  border-bottom px-2">Divulgación y/o difución de la ciencia a
                                    través
                                    de la participación</span></h6>
                            <ul class="list-group list-group-flush px-5">
                                <li class="list-group-item">Congresos - {{ $proyecto->divulgacion[0] }}</li>
                                <li class="list-group-item">Coloquios - {{ $proyecto->divulgacion[1] }}</li>
                                <li class="list-group-item">Conferecnias - {{ $proyecto->divulgacion[2] }}</li>
                                <li class="list-group-item">Articulos cientificos - {{ $proyecto->divulgacion[3] }}
                                </li>
                                <li class="list-group-item">Capitulos de libros - {{ $proyecto->divulgacion[4] }}</li>
                                @if (isset($proyecto->otros))
                                    <li class="list-group-item">Otro - {{ $proyecto->otros }}</li>
                                @endif
                            </ul>

                        </div>

                        <div class="col-md-6 mt-2 pt-2">
                            <h6><span class="border-2  border-bottom px-2">Vinculación con Cuerpos Académicos</span>
                            </h6>
                            {!! $proyecto->vinculacion_ca !!}
                        </div>
                    </div>


                    <div class="row text-center ">
                        <h4 class="mt-2 pt-2"><span class="border-1 border-dark border-bottom px-2">Redes de
                                vinculación</span>
                        </h4>
                        <div class="col-md-6 mt-2 pt-2">
                            <h6><span class="border-2  border-bottom px-2">A través de su proyecto se encuentra
                                    vinculado
                                    con redes académicas</span></h6>
                            {!! $proyecto->vinculacion_redes !!}
                        </div>
                    </div>
                    <div class="row  mx-5">
                        <h4 class="mt-4 pt-4 text-center"><span
                                class="border-1 border-dark border-bottom px-2">Recursos</span>
                        </h4>


                        <div class="col-md-6 mt-2 pt-2 ">
                            <table class="table">
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
                                    <td class="text-center">{{ $proyecto->recursos->p_01 }}</td>
                                </tr>
                                <tr>
                                    <td>3721 Transporte terrestre nacional</td>
                                    <td class="text-center">{{ $proyecto->recursos->p_02 }}</td>
                                </tr>
                                <tr>
                                    <td>3722 Casetas</td>
                                    <td class="text-center"> {{ $proyecto->recursos->p_03 }}</td>
                                </tr>
                                <tr>
                                    <td>3751 Hospedaje nacional </td>
                                    <td class="text-center">{{ $proyecto->recursos->p_04 }}</td>
                                </tr>
                                <tr>
                                    <td>3753 Alimentación nacional </td>
                                    <td class="text-center">{{ $proyecto->recursos->p_05 }}</td>
                                </tr>
                                <tr>
                                    <td>2611 Combustible </td>
                                    <td class="text-center">{{ $proyecto->recursos->p_06 }}</td>
                                </tr>
                                <tr>
                                    <td>2111 Papelería</td>
                                    <td class="text-center"> {{ $proyecto->recursos->p_07 }}</td>
                                </tr>
                                <tr>
                                    <td>2141 Tóner y memoria usb (para el caso de las memorias USB
                                        con precio unitario menor a $4,211.83 pesos)</td>
                                    <td class="text-center">{{ $proyecto->recursos->p_08 }}</td>
                                </tr>
                                <tr class=" border-top border-dark">
                                    <td class="text-end">
                                        Total
                                    </td>
                                    <td class="text-center">{{ $proyecto->monto_total }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-12 text-center pt-2 mt-2 ">
                            Justificacion del recurso <br>
                            {!! $proyecto->recursos->justificacion !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
