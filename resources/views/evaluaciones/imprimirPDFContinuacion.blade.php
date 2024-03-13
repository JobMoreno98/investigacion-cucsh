<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluación - Folio: {{ $proyecto->folio }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12">
                <div class="card w-100  shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <p class="text-center"><img class="img-responsive" src="images/logo.jpg" width="100%">
                                </p>
                            </div>
                        </div>

                        <h4 class="card-title text-center border-bottom mb-3 pb-3">Folio:
                            {{ $proyecto->ciclo->anio }}/{{ $proyecto->id }} <span class="mx-2 px-2"> Nombre responsable: {{$proyecto->user->name}}</span><br/>
Departamento: {{$proyecto->datosInv->departamento}}<br/>
                           Título: {{ $proyecto->titulo_proyecto }}
                        </h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <h4 class="text-center border-bottom mb-3 pb-3">Dictamen: {{ $evaluacion->dictamen }}
                                </h4>
                            </div>
                        </div>
                        <table class="table">
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
                    </div>

<div class="row mx-5">
<div class="col-sm-12">
<h4 class="card-title text-center border-bottom mb-3 pb-3">Dictamen</h4>

<table class="table bordered">
<tr>
<td>¿Cuenta con su informe de avance de investigación?</td>
<td>{{$evaluacion->avance}}</td>

</tr>

<tr>

<td> <small>¿El informe de avances de resultados del proyecto de investigación cuenta con el aval de su Colegio Departamental?</small></td>
<td>{{$evaluacion->informe}}</td>
</tr>
<tr>
<td>¿Solicita recursos económicos?</td>
<td>{{$evaluacion->recursos}}</td>
</tr>

</table>
</div>
</div>

                    <div class="row  mx-5">
                        <h4 class="mt-2 pt-2 text-center"><span
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
                                        <th>
                                            Monto aprobado
                                        </th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td> <small>3711 Transporte aéreo nacional </small></td>
                                    <td class="text-center"> <small>{{ $proyecto->recursos->p_01 }} </small></td>
                                    <td class="text-center"> <small>{{ $evaluacion->p_01 }} </small></td>
                                </tr>
                                <tr>
                                    <td>3721 Transporte terrestre nacional</td>
                                    <td class="text-center">{{ $proyecto->recursos->p_02 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_02 }}</td>
                                </tr>
                                <tr>
                                    <td>3722 Casetas</td>
                                    <td class="text-center"> {{ $proyecto->recursos->p_03 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_03 }}</td>
                                </tr>
                                <tr>
                                    <td>3751 Hospedaje nacional </td>
                                    <td class="text-center">{{ $proyecto->recursos->p_04 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_04 }}</td>
                                </tr>
                                <tr>
                                    <td>3753 Alimentación nacional </td>
                                    <td class="text-center">{{ $proyecto->recursos->p_05 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_05 }}</td>
                                </tr>
                                <tr>
                                    <td>2611 Combustible </td>
                                    <td class="text-center">{{ $proyecto->recursos->p_06 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_06 }}</td>
                                </tr>
                                <tr>
                                    <td>2111 Papelería</td>
                                    <td class="text-center"> {{ $proyecto->recursos->p_07 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_07 }}</td>
                                </tr>
                                <tr>
                                    <td>2141 Tóner y memoria usb (para el caso de las memorias USB
                                        con precio unitario menor a $4,211.83 pesos)</td>
                                    <td class="text-center">{{ $proyecto->recursos->p_08 }}</td>
                                    <td class="text-center">{{ $evaluacion->p_08 }}</td>
                                </tr>
                                <tr class=" border-top border-dark">
                                    <td class="text-end">
                                        Total
                                    </td>
                                    <td class="text-center">{{ number_format($proyecto->total) }}</td>
                                    <td class="text-center">{{ number_format($evaluacion->total) }}</td>


                                </tr>
                            </table>
                        </div>


                        <div class="col-sm-6 text-center pt-2 mt-2 ">


    <table class="table">
        <tr>
            <td><span class="fw-bold">Justificacion del recurso</span>  <br>
                            {!! $proyecto->recursos->justificacion !!}</td>
            <td>            @php
                date_default_timezone_set('America/Mexico_City');
            @endphp
            </td>
        </tr>
    </table>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <br>
            <br>
        </div>
    </div>

</body>

</html>
