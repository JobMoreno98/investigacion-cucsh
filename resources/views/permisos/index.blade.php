@extends('adminlte::page')
@section('title', 'Permisos')

@section('preloader')
    <i class="fas fa-4x fa-spin fa-spinner text-secondary"></i>
    <h4 class="mt-4 text-dark">Loading</h4>
@stop

@section('css')
    @include('layouts.head')
@endsection

@section('content')
    <div class="container-fluid">
        @if (Auth::check())
            @if (session('message'))
                <div class="alert alert-success">
                    <h2>{{ session('message') }}</h2>
                </div>
            @endif
            <div class="row mt-2">
                <h2>Administración de Permisos</h2>
            </div>
            <div class="d-flex justify-content-betteewn">
                <div class="col-sm-12 col-md-3">
                    <form method="POST" action="{{ route('permisos.store') }}">
                        @csrf
                        <div class="d-flex flex-column justify-content-center">
                            <div class="m-1">
                                <label for="permiso" class="col-form-label text-md-right">{{ __('Nuevo Permiso') }}</label>
                            </div>
                            <div class="m-1">
                                <input id="permiso" type="text" class="form-control" name="permiso"
                                    placeholder="NOMBRE_DEL_MODULO#accion" required>
                            </div>
                            <div class=" m-1">
                                <button type="submit" class="btn btn-primary">{{ __('Nuevo Permiso') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-9">
                    <table id="usersTable" class=" display table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Modulo</th>
                                <th>Permiso</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permisos as $permiso)
                                <tr>
                                    <td>{{ $permiso['modulo'] }}</td>
                                    <td>{{ $permiso['permiso'] }}</td>
                                    <td>
                                        <form method="GET" action="{{ route('permisos.edit', $permiso['id']) }}">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                {{ __('Eliminar') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        @else
            El periodo de Registro de Proyectos a terminado
        @endif
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "pageLength": 10,
                "order": [
                    [0, "asc"]
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
            });
        });
    </script>
@endsection
