@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="card w-100  shadow-sm">
                    <div class="card-body">
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header " id="flush-headingOne">
                                    <button class="accordion-button collapsed text-center" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        Ver informacion del proyecto
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    @include('evaluaciones.informacion')
                                </div>
                            </div>
                        </div>
                        <h4 class="text-center my-2">Lista de evaluadores</h4>
                        <hr>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Division</th>
                                    <th>Departamento</th>
                                    <th>Asignar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($evalaudores as $key => $item)
                                    <tr>
                                        
                                        <td>{{ $item->name }} </td>
                                        <td>{{ $item->departamento }}</td>
                                        <td>{{ $item->division }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('asignar_evaluador', [$proyecto, $item->id]) }}">
                                                Asignar este evalaudor
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
    <script>
        function asignar() {
            document.getElementById('form-asignar').submit();
        }
    </script>
@endsection
