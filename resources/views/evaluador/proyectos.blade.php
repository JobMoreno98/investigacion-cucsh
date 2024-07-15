@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    <span class="text-center">
                        {{ session('message') }}
                    </span>
                </div>
            @endif
            <div class="col-sm-12">
                <table class="table align-middle compact order-column " id="myTable">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Folio</th>
                            <th class="text-center">Título</th>
                            <th class="text-center">Archvios</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            <tr>
                                <td>{{ $item->proyecto->id }}</td>
                                <td>{{ $item->proyecto->ciclo->anio . '/' . $item->proyecto->folio }}</td>
                                <td>{{ $item->proyecto->titulo_proyecto }}</td>
                                <td class="text-center" style="width: 300px;">
                                    <a href="{{ route('local.temp', ['id' => $item->proyecto->id, 'tipo' => 'extenso']) }}"
                                        class=" btn btn-secondary btn-sm my-1" target="_blank">Proyecto</a>

                                    <a href="{{ route('local.temp', ['id' => $item->proyecto->id, 'tipo' => 'cronograma']) }}"
                                        class=" btn btn-primary btn-sm my-1" target="_blank">Cronograma</a>

                                    <a href="{{ route('local.temp', ['id' => $item->proyecto->id, 'tipo' => 'completo']) }}"
                                        class="btn  text-white btn-sm my-1" style="background:#9124a3;"target="_blank">Detalles</a>
                                </td>
                                <td style="width:150px;">
                                    @if (strcmp($item->dictamen, '-') == 0)
                                        <a href="{{ route('crear-evaluacion', $item->proyecto) }}"
                                            class="my-1 w-100 btn btn-sm btn-success">Evaluar</a>
                                    @else
                                        @if ($item->definitivo == 1)
                                            <p>La evaluación se envio como definitiva</p>
                                        @else
                                            <a href="{{ route('evaluaciones.edit', $item->id) }}"
                                                class=" my-1 w-100 btn btn-sm btn-primary">Ver evaluacion</a>
                                            <a href="{{ route('evaluacion.definitiva', $item->id) }}"
                                                class=" my-1 w-100 btn btn-sm btn-warning">Enviar definitivo</a>
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
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>
@endsection
