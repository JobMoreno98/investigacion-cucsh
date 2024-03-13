@extends('layouts.app')

@section('content')
    <div class="container">
        @if (isset($tipo))
            <h5 class="text-center">{{ ucwords(str_replace('_', ' ', $tipo)) }} /
                {{ ucwords(str_replace('_', ' ', $valor)) }} </h5>
        @endif
        <div class="row py-3 my-3 border-bottom">
            <h3 class="text-center">Reportes disponibles</h3>
            <div class="col-sm-12 col-md-3">
                <a href="{{ route('filtro-reportes', 'recursos') }}" class="btn btn-secondary">Ver reporte por recursos</a>
            </div>

        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <table class="table align-middle compact order-column" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Folio</th>
                            <th>Título</th>
                            <th>Nombre</th>
                            <th>Departamento</th>
                            <th>Tipo de proyecto</th>
                            <th>Tipo de registro</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            @if ($item->total != 0)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->folio }}</td>
                                    <td>{{ $item->titulo_proyecto }}</td>
                                    <td>{{ $item->user->name }}</td>

                                    <td>{{ $item->datosInv->departamento }}</td>

                                    <td>{{ $item->tipo_registro }}</td>
                                    <td>{{ $item->tipo_proyecto }}</td>
                                    <td>{{ $item->total }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        let tipo = "<?php echo isset($tipo) ? $tipo : ''; ?>";
        let valor = "<?php echo isset($valor) ? $valor : ''; ?>";
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                "pageLength": 10,
                columnDefs: [{
                        target: 0,
                        visible: false,
                    },
                    {
                        target: 4,
                        visible: false,
                    },
                    {
                        target: 5,
                        visible: false,
                    },
                    {
                        target: 6,
                        visible: false,
                    },
                ],
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
                responsive: true,
                // dom: 'Bfrtip',
                dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Proyectos de investigación',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Data export'
                    }
                ]
            })
        });


        jQuery.extend(jQuery.fn.dataTableExt.oSort, {
            "portugues-pre": function(data) {
                var a = 'a';
                var e = 'e';
                var i = 'i';
                var o = 'o';
                var u = 'u';
                var c = 'c';
                var special_letters = {
                    "Á": a,
                    "á": a,
                    "Ã": a,
                    "ã": a,
                    "À": a,
                    "à": a,
                    "É": e,
                    "é": e,
                    "Ê": e,
                    "ê": e,
                    "Í": i,
                    "í": i,
                    "Î": i,
                    "î": i,
                    "Ó": o,
                    "ó": o,
                    "Õ": o,
                    "õ": o,
                    "Ô": o,
                    "ô": o,
                    "Ú": u,
                    "ú": u,
                    "Ü": u,
                    "ü": u,
                    "ç": c,
                    "Ç": c
                };
                for (var val in special_letters)
                    data = data.split(val).join(special_letters[val]).toLowerCase();
                return data;
            },
            "portugues-asc": function(a, b) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },
            "portugues-desc": function(a, b) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        });
        //"columnDefs": [{ type: 'portugues', targets: "_all" }],            
    </script>
@endsection
