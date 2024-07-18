@extends('adminlte::page')

@section('css')
    @include('layouts.head')
@endsection
@section('content')
    <div class="container">
        <h3 class="text-uppercase text-center my-4">mis proyectos</h3>
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
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proyectos as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->ciclo->anio ."/".$item->folio }}</td>
                                <td>{{ $item->titulo_proyecto }}</td>
                                <td>{{ $item->user->name }}</td>

                                <td>{{ $item->datosInv->departamento }}</td>

                                <td>{{ $item->tipo_registro }}</td>
                                <td>{{ $item->tipo_proyecto }}</td>

                                <td style="width:150px;">
                                    <a href="{{ route('proyectos.show', $item->id) }}"
                                        class="btn-sm m-1 btn btn-primary w-100">Detalles</a>
                                    @if ($item->definitivo == 0 && $item->user_id == Auth::user()->id)
                                        <a href="{{ route('proyectos.definitivo', $item->id) }}"
                                            class=" btn-sm m-1 btn btn-warning w-100 text-white">Enviar definitivo</a>
                                    @else
                                        @if ($item->definitivo == 0)
                                            <button class="btn mx-1 px-1"><span
                                                    class="border-end border-dark px-1 mx-1 w-50">Definitivo </span><span
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

@endsection
@section('js')
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
                    title: 'Proyectos de investigación',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }
            ]
        })

        $('a.boton').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = table.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        });
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