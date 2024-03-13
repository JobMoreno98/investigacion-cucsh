@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Auth::user()->role == 'admin' || Auth::user()->s_role == 'admin')
            @include('proyectos.reportes')
        @endif

        <div class="row">
            <div class="col-sm-12">
                <table class="table align-middle compact order-column" id="myTable">
                    <thead>
                        <tr>
                            @for ($i = 0; $i < count($titulos); $i++)
                                <th>{{ $titulos[$i] }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script type="text/javascript">
        var tipo = "<?php echo isset($tipo) ? $tipo : ''; ?>";
        var valor = "<?php echo isset($valor) ? $valor : ''; ?>";
        console.log(tipo);


        $(document).ready(function() {
            const tiempoTranscurrido = Date.now();
            const hoy = new Date(tiempoTranscurrido);
            let nombre = 'Reporte proyectos de investigación ' + tipo + ' ' + hoy.toISOString();
            var columnas = @json($columnas);
            var data = @json($proyectosFin);
            //console.log(data);
	    $('#myTable').append('<caption style="caption-side: bottom">Rubro: 2111 Papeleria <br> Rubro 2141: Toner y memoria usb  </caption>');
            var table = $('#myTable').DataTable({
                data: data,
                columnDefs: columnas,
                "pageLength": 10,
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
                    extend: 'excelHtml5', footer: true,
                    title: nombre,
		    messageBottom: 'The information in this table is copyright to Sirius Cybernetics Corp. prueba'
                }, ]
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
