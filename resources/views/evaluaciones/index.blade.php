@extends('adminlte::page')
@section('title', 'Asignaciones')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">{{ __('Loading') }}</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection
@section('content')
    <div class="container-fluid p-5">
        <div class="row my-2 justify-content-center">
            <div class="col-sm-12">
                <table class="w-100 table align-middle compact order-column" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Folio</th>
                            <th>Título</th>
                            <th>Nombre</th>
                            <th>Evaluador</th>
                            <th>Dictamen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->ciclo->anio . '/' . $item->folio }}</td>
                                <td>{{ $item->titulo_proyecto }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>
                                    @if ($item->evaluador->id != 1)
                                        {{ $item->evaluador->name }}
                                    @else
                                        @if (strcmp($item->tipo_registro, 'Proyecto continuación') == 0)
                                            <p>Proyecto continuación</p>
                                        @else
                                            <p>No se ha asigando evaluador</p>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if (!isset($item->evaluacion->dictamen))
                                        No hay dictamen
                                    @else
                                        {{ $item->evaluacion->dictamen }}
                                    @endif
                                </td>
                                <td style="width:200px;">
                                    @if ($item->evaluador->id != 1)
                                        @if (strcmp($item->evaluacion->dictamen, '-') == 0)
                                            <p class="text-center">Aun no ha sido evaluado
                                                <a class="btn p-0 m-0 w-100 btn-primary"
                                                    href="{{ route('evaluaciones.show', $item->id) }}">Asiganar
                                                    evaluador</a>
                                            </p>
                                        @else
                                            @if ($item->evaluacion->definitivo == 0)
                                                <p>Aun no se envia a definitivo la evalaución</p>
                                            @else
                                                <a href="{{ route('imprimirEvalaucion', $item) }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="btn btn-success btn-sm w-100 ">Imprimir</a>
                                            @endif
                                        @endif
                                    @else
                                        @if (strcmp($item->tipo_registro, 'Proyecto continuación') == 0)
                                            <a class="btn p-0 m-0 w-100 btn-secondary"
                                                href="{{ route('evaluaciones.continuacion', $item->id) }}">Evaluar</a>
                                        @else
                                            <a class="btn p-0 m-0 w-100 btn-primary"
                                                href="{{ route('evaluaciones.show', $item->id) }}">Asiganar evaluador</a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                    target: 0,
                    visible: false,
                }, ],
                responsive: true,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Proyectos de investigación',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }

                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Proyectos de investigación',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                ]
            });
        });
    </script>
@endsection
