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
                <table class="table align-middle compact order-column" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Folio</th>
                            <th>Título</th>
                            <th>Nombre</th>
                            <th>Proyecto extenso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            <tr>
                                <td>{{ $item->proyecto->id }}</td>
                                <td>{{ $item->proyecto->folio }}</td>
                                <td>{{ $item->proyecto->titulo_proyecto }}</td>
                                <td>{{ $item->proyecto->user->name }}</td>
                                <td>
<a href="{{ url('/storage/anexos/' . $item->proyecto->anexo) }}" target="_blank">Ver
                                        proyecto</a> </td>
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
