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

                        <h5 class="card-title text-center border-bottom mb-3 pb-3">Folio:
                            {{ $proyecto->folio }}
                            <br /> Título: {{ $proyecto->titulo_proyecto }}
                        </h5>
                    </div>

                    <div class="row mx-3">
                        <h4 class="mt-1 pt-1 text-center"><span
                                class="border-1 border-dark border-bottom px-2">Evaluación:
                                {{ $evaluacion->dictamen }}</span>
                        </h4>
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>a. Queda explicito en el proyecto presentado la importancia de la investigación en la
                                generación de conocimiento y/o incidencia *</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_01[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_01[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>b. La propuesta de investigación es un problema novedoso y relevante</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_02[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_02[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        {{-- Pregunta 3 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>1.- El título del proyecto es claro y es coherente con el planteamiento de la
                                investigación propuesta</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_03[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_03[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 4 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>2.- El resumen refleja los elementos esenciales para el logro del cumplimiento de la
                                investigación</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_04[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_04[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pregunta 5 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>3.- Justifica de manera clara y coherente el por qué y para qué se quiere estudiar e
                                investigar ese problema</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_05[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_05[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 6 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>4.- La metodología expone el camino a seguir para el logro de los objetivos propuestos
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_06[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_06[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 7 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>5.- Los objetivos son claros y permiten visualizar el propósito de la investigación</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_07[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_07[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 8 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>6.- Las preguntas y/o hipótesis son adecuadas de acuerdo con la naturaleza del proyecto
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_08[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_08[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 9 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>7.- Se establece el tipo de proyecto y se encuentra vinculada con la metodología descrita
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_09[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_09[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>



                        {{-- Pregunta 10 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>8.- Se establecen los criterios éticos para el desarrollo de la investigación</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_10[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_10[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 10 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>9.- Presenta un cronograma de trabajo y sus actividades permiten el cumplimiento de los
                                objetivos de investigación</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_11[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_11[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 11 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>10.- En caso de solicitar presupuesto este se encuentra justificado en función del
                                proyecto y va de acuerdo con las normas de austeridad de la Universidad de Guadalajara
                            </p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{!! $evaluacion->p_12[0] !!}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_12[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        {{-- Pregunta 12 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>De acuerdo con la pregunta anterior (10) señale el porcentaje del presupuesto
                                autorizado<br><b>** En caso de no solicitar recurso favor de colocar -1</b></p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Calificación
                                        </th>
                                        <th>
                                            Argumentos
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <p>{{ $evaluacion->p_13[0] }}</p>
                                        </td>
                                        <td>{!! $evaluacion->p_13[1] !!}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Pregunta 12 --}}
                        <div class="col-md-6 mt-2 pt-2 ">
                            <p>Observaciones y sugerencias</p>
                            {!! $evaluacion->observaciones !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <br>
            <br>
            @php
                date_default_timezone_set('America/Mexico_City');
            @endphp
            <p class="pie">Hora y día de impresión: {{ date('d-m-Y H:i:s') }}<br>
                Realizado por: {{ Auth::user()->name }}<br>
                Formato CTA-050. Actualización: 15/marzo/2023</p>
        </div>
    </div>

</body>

</html>
