@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Titulo</th>
                            <th>Responsable</th>
                            <th>Evaluador</th>
                            <th>Dictamen</th>
                            <th>Informe</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($asigandos as $key => $value)
                            <tr>
                                <td> {{ $value->proyecto->folio }}</td>
                                <td>{{ $value->proyecto->titulo_proyecto }}</td>
                                <td>{{ $value->proyecto->user->name }}</td>
                                <td>{{ $value->proyecto->evaluador->name }}</td>
                                <td>
                                        {{ $value->dictamen }}
                                </td>
                                <td></td>
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
                "order": [0, 'asc'],
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
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LETTER',
                    }

                ]
            });
        });
    </script>
@endsection
