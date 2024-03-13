@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table align-middle compact order-column" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Folio</th>
                            <th>Título</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->folio }}</td>
                                <td>{{ $item->titulo_proyecto }}</td>
                                <td>{{ $item->user->name }}</td>

                                <td style="width:150px;">
                                    <a href="{{ route('proyectos.show', $item->id) }}"
                                        class="btn-sm m-1 btn btn-primary w-100">Detalles</a>
                                    @if ($item->definitivo == 0 && $item->user_id == Auth::user()->id)
                                        <a href="{{ route('proyectos.definitivo', $item->id) }}"
                                            class=" btn-sm m-1 btn btn-warning w-100 text-white">Enviar definitivo</a>
                                    @else
                                        @if ($item->definitivo == 0)
                                            <button class="btn mx-1 px-1"><span
                                                    class="border-end border-dark px-1 mx-1 w-50 btn-sm">Definitivo </span><span
                                                    class="w-50">No</span> </button>
                                        @else
                                            @if (Auth::user()->role == 'admin' || Auth::user()->s_role == 'admin')
                                                <a href="{{ route('proyectos.definitivo', $item->id) }}"
                                                    class=" btn-sm m-1 btn btn-success w-100 text-white">Devolver
                                                    definitivo</a>
                                            @endif
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
